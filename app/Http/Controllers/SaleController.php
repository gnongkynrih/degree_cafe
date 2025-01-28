<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Menu;
use App\Models\Sale;
use App\Models\Seat;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
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
        return view('sale.index')
            ->with('seat',$seat)
            ->with('categories',$categories)
            ->with('menus',$menus)
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
            ->where('status','pending')->last();
        }
       

        //save all the items in the orders table
        foreach($items as $item){
            Order::create([
                'sale_id' => $sale->id,
                'menu_id' => $item['id'],
                'quantity' => $item['quantity'],
                'amount' => $item['price'],
            ]);
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
            ['message' => 'Something went wrong. Please try again later'],503
        );
       }else{
        return response()->json(['sale' => $sale,'items' => $items],200);
       }
    }

}
