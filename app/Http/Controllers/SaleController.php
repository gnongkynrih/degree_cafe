<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Sale;
use App\Models\Seat;
use App\Models\Order;
use Razorpay\Api\Api;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Browsershot\Browsershot;

class SaleController extends Controller
{
    public function showTableForPayment(){
        //select * from seats where status in ('active','occupied')
        $seats = Seat::where( 'status','occupied' )->get();
        if($seats->isEmpty()){
            return redirect()->back()->with('failure','No payment to receive');
        }

        return view('sale.show_table_payment')->with('seats',$seats);
    }
    public function showTables(){
        //select * from seats where status in ('active','occupied')
        $seats = Seat::whereIn( 'status',['active','occupied'] )->get();
        return view('sale.show_tables')->with('seats',$seats);
    }

    public function pos(){
        return view('sale.pos');
    }

    public function index($table_no,$id = null){
        $seat = Seat::find($table_no);
        $categories = Category::where('status','=','active')
            ->orderBy('name','asc')->get();
        if($id == null){
            $menus = Menu::where('status','=','active')->orderBy('name','asc')->get();
            $activeLink = 'all';
        }else{
            $menus = Menu::where('category_id','=',$id)
            ->where('status','=','active')
            ->orderBy('name','asc')->get();
            $activeLink = $id;
        }
        //check if the table has any orders
        $sale = Sale::where('table_no','=',$table_no)
            ->where('status','=','pending')
            ->latest()->first();
        if($sale == null){
            $orders = [];
        }else{
            $orders = Order::where('sale_id','=',$sale->id)->get();
        }
        return view('sale.index')
            ->with('seat',$seat)
            ->with('categories',$categories)
            ->with('menus',$menus)
            ->with('orders',$orders)
            ->with('activeLink',$activeLink);
    }

    public function confirmOrder(Request $request,$table_no){
        $error = true;
        $items = $request->items;
        //check if the table no is occupied
        $seat = Seat::find($table_no);
        if($seat == null){
            return response()->json(['message' => 'Invalid table no.']);
        }
       try{
        DB::beginTransaction(); //start a database transaction

        
         if($seat->status == 'active'){ //means the table is empty
            $sale = new Sale();
            $sale->table_no = $table_no;
            $sale->invoice_date = Carbon::now();
            $sale->status = 'pending';
            $sale->save();
        }else if($seat->status == 'occupied'){ //means the table is occupied
            $sale = Sale::where('table_no','=',$table_no)
            ->where('status','pending')->latest()->first();
        }
       

        //save all the items in the orders table
        foreach($items as $item){
            $order = Order::where('sale_id','=',$sale->id)
                ->where('menu_id','=',$item['id'])->first();
            if($order == null){
                $order  = new Order();
            }
            $order->sale_id = $sale->id;
            $order->menu_id = $item['id'];
            $order->quantity = $item['quantity'];
            $order->amount = $item['price'];
            $order->save();
        }

        //mark the table as occupied
        $seat->status = 'occupied';
        $seat->save();

        DB::commit(); //commit the transaction
        $error = false;
       }catch(\Exception $e){
        DB::rollBack(); //rollback the transaction if an exception is thrown
       }
       if($error){
        return response()->json(
            ['message' => $e->getMessage(),
        'status'=>'error'],503
        );
       }else{
        return response()->json(['status'=>'success'],200);
       }
    }

    public function getOrdersByTableNo($table_no){
        $sale = Sale::where('table_no','=',$table_no)
        ->where('status','pending')->latest()->first();

        if($sale == null){
            return response()->json(['message' => 'Invalid table no.'],404);
        }
        $data = '<table class="w-full text-sm text-left text-black dark:text-gray-400">
        <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
        Table No. ' . $sale->table_no . '
        </caption>
        <thead class="text-xl text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"><tr>
        <th>Menu</th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Total</th>
        </tr></thead><tbody>';
        $total = 0;
        foreach($sale->orders as $order){
            $subtotal = $order->quantity * $order->amount;
            $total += $subtotal;
            $data .= '<tr class="border-b border-gray-200 odd:bg-grey-400 even:bg-white">
            <td class="px-2 py-4">'.$order->menu->name.'</td>
            <td>'.$order->quantity.'</td>
            <td>'.$order->amount.'</td>
            <td>'. $subtotal .'</td>
            </tr>';
        }
        $data .= '<tr>
        <td colspan="3" class="px-2 py-1 text-right font-bold">Grand Total</td>
        <td id="grandTotal" class="px-2 py-1 font-bold">' . $total .'</td>
        </tr></tbody></table>';
        return response()->json(['data' => $data,'saleId'=>$sale->id],200);
    }

    public function confirmPayment($id){
        $sale = Sale::findOrFail($id);
        if($sale->status == 'paid'){
            return response()->json(['message' => 'Sale already paid.'],400);
        }
        //get the invoice number
        $maxInvoiceNumber = Sale::where('invoice_date', '=', $sale->invoice_date)
                                    ->latest()
                                    ->first();
        if($maxInvoiceNumber == null){
            $invoiceNumber = 1;
        }else{
            $invoiceNumber = $maxInvoiceNumber->invoice_number + 1;
        }
        try{
            DB::beginTransaction();
            //calculate the total amount of the sale
            $total = 0;
            foreach($sale->orders as $order){
                $total += $order->quantity * $order->amount;
            }
            $orderData = [
                'amount' => $total * 100, //amount in paise
                'currency' => 'INR'
            ];
            //get the api from my .env file
            $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
            //generate the order id from razorpay
            $razorpayOrder = $api->order->create($orderData);
            $order_id = $razorpayOrder->id;
            
            $sale->invoice_number = $invoiceNumber;
            $sale->total = $total;
            $sale->amount = $total;
            $sale->status='awaiting';
            $sale->razorpay_order_id = $order_id;
            $sale->save();
            //store the sale id in a session
            session(['sale_id' => $sale->id]);
            //update the status of the seat
            $seat = Seat::find($sale->table_no);
            $seat->status = 'active';
            $seat->save();
            session(['order_id' => $order_id]);
            DB::commit();
            return redirect()->route('sale.razorpay_payment',[$sale]);
        }catch(\Exception $e){
            DB::rollBack(); //rollback the transaction if an exception is thrown
            return response()->json([
                'status' =>'failed',
                'message' => $e->getMessage()],500);
        }

    }

    public function razorpayPayment(Sale $payment){
        return view('sale.razorpay_payment')->with('payment',$payment);
    }
    public function processPayment(Request $request){
        
        if (!empty($request->razorpay_payment_id)) {
            try {
                $razorpaymentId = $request->razorpay_payment_id;
                $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
                $response = $api->payment->fetch($razorpaymentId);
                $sale = Sale::where('razorpay_order_id',session('order_id'))->first();
                if($sale != null){
                    $sale->status = 'paid';
                    $sale->razorpay_payment_id = $razorpaymentId;
                    $sale->save();
                }
                
                session(['payment_id' => $razorpaymentId]);
                return redirect()->route('sale.razorthankyou')->with('payment',$sale)
                ->with('successMessage','Payment successful');
            } catch (Exception $e) {
                return back()->with('errorMessage',$e->getMessage());
            }
        }else{
            return back()->with('errorMessage',$e->getMessage());
        }
       
    }

    public function RazorThankYou()
    {
        $payment = Sale::where('razorpay_payment_id',session('payment_id'))->first();
        return view('sale.thankyou',compact('payment'));
    }

    public function downloadReceipt($payment_id){
        $sale = Sale::where('razorpay_payment_id',$payment_id)->first();
        
        $data = view('sale.receipt',compact('sale'))->render();
        $pdf = Browsershot::html($data)
        ->paperSize('5.83', '8.27','in')
        ->save($sale->invoice_number.'.pdf');
        return response()->download(public_path($sale->invoice_number.'.pdf'));
    }
}
