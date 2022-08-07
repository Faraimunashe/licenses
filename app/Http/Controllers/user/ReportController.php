<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use DB;

class ReportController extends Controller
{
    public function index()
    {
        $chart = (new LarapexChart)->pieChart()
            ->setTitle('Analysis of transaction status.')
            ->setSubtitle('as at year 2022')
            ->addData([
                Transaction::where('status', '=', 'successful')->count(),
                Transaction::where('status', '!=', 'successful')->count()
            ])
            ->setColors(['#ffc63b', '#ff6384'])
            ->setLabels(['Successful Transactions', 'Failed Transactions']);

        return view('user.report',[
            'chart' => $chart
        ]);
    }
}
