<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportGenerateController extends Controller
{
    public function reportPage(){

        return view('pages.dashboard.report-page');
    }

    public function salesReport(Request $request){
        return view('pages.report.sales-report');
    }
}
