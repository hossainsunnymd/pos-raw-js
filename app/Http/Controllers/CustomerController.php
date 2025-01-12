<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function listCustomer(Request $request){
         $userId=$request->header('id');
         return Customer::where('user_id','=',$userId)->get();
    }

    public function createCustomer(Request $request){
        $userId=$request->header('id');
       try{
        Customer::create([
            'name'=>$request->name,
            'user_id'=>$userId,
            'email'=>$request->email,
            'mobile'=>$request->mobile
        ]);
        return response()->json([
            'status' => "success",
            'message' => "Customer Created Successfully"
        ],201);

       }catch(Exception $e){
        return response()->json([
            'status' => "failed",
            'message' => "Customer Creation Failed",
            'id'=>$userId
        ]);
       }
    }

    public function updateCustomer(Request $request){
      try{
        $userId=$request->header('id');
        $id=$request->input('id');
        Customer::where('id','=',$id)->where('user_id','=',$userId)->update([
           'name'=>$request->name,
           'email'=>$request->email,
           'mobile'=>$request->mobile
        ]);
        return response()->json([
           'status' => "success",
           'message' => "Customer Updated Successfully"
       ],201);
      }catch(Exception $e){
        return response()->json([
            'status' => "failed",
            'message' => "Customer Updation Failed"
        ]);
      }
    }

    public function deleteCustomer(Request $request){
        $userId=$request->header('id');
        $id=$request->input('id');
        Customer::where('id','=',$id)->where('user_id','=',$userId)->delete();
        return response()->json([
            'status' => "success",
            'message' => "Customer Deleted Successfully",
            'id'=>$id
        ],200);
    }

    public function customerById(Request $request){
        $userId=$request->header('id');
        return Customer::where('id','=',$request->id)->where('user_id','=',$userId)->first();
    }

    public function customerPage(){
        return view('pages.dashboard.customer-page');
    }
}
