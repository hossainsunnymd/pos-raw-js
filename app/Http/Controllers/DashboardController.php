<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function summary(Request $request){


        $customer=Customer::where('user_id','=',$request->header('id'))->count();
        $product=Product::where('user_id','=',$request->header('id'))->count();
        $category=Category::where('user_id','=',$request->header('id'))->count();
        $invoice=Invoice::where('user_id','=',$request->header('id'))->count();
        $total=Invoice::where('user_id','=',$request->header('id'))->sum('total');
        $vat=Invoice::where('user_id','=',$request->header('id'))->sum('vat');
        $payable=Invoice::where('user_id','=',$request->header('id'))->sum('payable');

        return [
            'customer'=>$customer,
            'product'=>$product,
            'category'=>$category,
            'invoice'=>$invoice,
            'total'=>$total,
            'vat'=>$vat,
            'payable'=>$payable
        ];
    }
}
