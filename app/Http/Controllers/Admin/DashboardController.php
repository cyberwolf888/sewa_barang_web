<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index()
    {
        $chart = '[';
        for($i=1; $i<=12; $i++){
            $_profit = \DB::table('iklan')->select(\DB::Raw('COUNT(id) as total'))->whereRaw("MONTH(created_at) = ".$i)->get()[0]->total;
            $profit = $_profit == '' ? 0 : $_profit;
            $chart.='['.'"'.strtoupper(date('M', strtotime('01-' . $i . '-2017'))).'",'.$profit.'],';
        }
        $chart = substr($chart, 0, -1).']';
        return view('admin.dashboard.index',[
            'chart'=>$chart
        ]);
    }

}
