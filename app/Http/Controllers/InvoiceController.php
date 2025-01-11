<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function invoicePage(){
        return view('pages.dashboard.invoice-page');
    }

    public function salePage(){
        return view('pages.dashboard.sale-page');
    }

    public function createInvoice(Request $request){

        DB::beginTransaction();
        try{

            $userId=$request->header('id');
            $data=[
               'total'=>$request->total,
               'discount'=>$request->discount,
               'vat'=>$request->vat,
               'payable'=>$request->payable ,
               'user_id'=>$userId,
               'customer_id'=>$request->cus_id,
            ];

            $invoice=Invoice::create($data);

            $porducts=$request->products;

            foreach($porducts as $product){
                InvoiceProduct::create([
                    'user_id'=>$userId,
                    'invoice_id'=>$invoice->id,
                    'product_id'=>$product['p_id'],
                    'qty'=>$product['qty'],
                    'sales_price'=>$product['total'],
                ]);
            }

            DB::commit();
            return 1;

        }catch(Exception $e){
            DB::rollBack();
            return 0;
        }

    }

    public function listInvoice(Request $request){
        $userId=$request->header('id');
        return Invoice::where('user_id','=',$userId)->with('customer')->get();
    }

    public function invoiceDetail(Request $request){

        $userId=$request->header('id');
        $customer_detail=Customer::where('id','=',$request->cus_id)->where('user_id','=',$userId)->first();
        $invoice_detail=Invoice::where('id','=',$request->inv_id)->where('user_id','=',$userId)->first();
        $invoice_products=InvoiceProduct::where('invoice_id','=',$request->inv_id)->where('user_id','=',$userId)
            ->with('product')->get();

        return array(
            'customer_detail'=>$customer_detail,
            'invoice_detail'=>$invoice_detail,
            'invoice_products'=>$invoice_products
        );

    }

    public function deleteInvoice(Request $request){
        $userId=$request->header('id');
        $id=$request->input('id');
        DB::beginTransaction();
        try{

            InvoiceProduct::where('invoice_id','=',$id)->where('user_id','=',$userId)->delete();
            Invoice::where('id','=',$id)->where('user_id','=',$userId)->delete();
            DB::commit();
            return 1;
        }catch(Exception $e){
            DB::rollBack();
            return 0;

        }
    }
}
