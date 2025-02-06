<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function saleReport(){
        //get the total sale for the last 7 days order by date
        $startDate = Carbon::now()->subDays(7);
        $endDate = Carbon::now();
        //get the total sale for the last 7 days
        $sql = "select DATE(invoice_date) as sale_date, 
        SUM(total) as daily_total 
        from sales 
        where status='paid' and invoice_date between ? and ?
        group by DATE(invoice_date)";
        $dailySalesLastWeek = DB::select($sql, [$startDate, $endDate]);
        
        // Prepare data for Chart.js
        $labels = [];
        $data = [];
        $i = 0;
        foreach($dailySalesLastWeek as $key => $value){
            $labels[] = $value->sale_date;
            $data[] = $value->daily_total;
        }

        //get the total sale for the last 7 days order by category
        $sql = "select c.name,sum(s.total) as total
            from sales s
            inner join orders on orders.sale_id = s.id
            inner join menus on orders.menu_id = menus.id
            inner join categories c on c.id = menus.category_id
            where s.status='paid' and s.invoice_date between ? and ?
            group by c.name;";
        $categorySales = DB::select($sql, [$startDate, $endDate]);
        $lblCategory = [];
        $dataCategory = [];
        foreach($categorySales as $key => $value){
            $lblCategory[] = $value->name;
            $dataCategory[] = $value->total;
        }
        return view('report.sale-report')
            ->with('data',$data)->with('labels',$labels)
            ->with('lblCategory',$lblCategory)
            ->with('dataCategory',$dataCategory);   
    }
}
