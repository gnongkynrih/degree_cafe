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

        $dailySalesLastWeek = DB::table('sales')
            ->select(DB::raw('DATE(created_at) as sale_date'), DB::raw('SUM(total) as daily_total')) // Select date and sum of total
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy(DB::raw('DATE(created_at)')) // Group by date part of created_at
            ->orderBy('created_at') // Optional: Order by date
            ->get();
        // Prepare data for Chart.js
        $labels = $dailySalesLastWeek->pluck('sale_date'); // Dates for the x-axis
        $data = $dailySalesLastWeek->pluck('daily_total'); // Sales totals for the y-axis

        return view('report.sale-report')->with('data',$data)->with('labels',$labels);   
    }
}
