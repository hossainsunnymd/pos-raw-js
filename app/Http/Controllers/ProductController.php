<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;




class ProductController extends Controller
{
    public function createProduct(Request $request){
          try{
            $userId=$request->header('id');
           $data=[
            'user_id'=>$userId,
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'price'=>$request->price,
            'unit'=>$request->unit
           ];

           //image uploads
           $file=$request->file('image');
           $filename=$file->getClientOriginalName();
           $t=time();
           $img_name="{$userId}-{$t}-{$filename}";
           $filePath="storage/images/{$img_name}";

           $data['image']=$filePath;

           $file->storeAs('images',$img_name,'public');

           Product::create($data);
           return response()->json([
               'status' => "success",
               'message' => "Product Created Successfully"
           ],201);
          }catch(Exception $e){
            return response()->json([
                'status' => "failed",
                'message' => "Product Creation Failed"
            ]);
          }

    }

    public function listProduct(Request $request){
        $userId=$request->header('id');
        return Product::where('user_id','=',$userId)->with('category')->get();
    }

    public function updateProduct(Request $request){
     try{
        $id=$request->query('id');
        $userId=$request->header('id');

         if($request->hasFile('image')){

            $data=[
                'category_id'=>$request->category_id,
                'name'=>$request->name,
                'price'=>$request->price,
                'unit'=>$request->unit
            ];

            $file=$request->file('image');
            $filename=$file->getClientOriginalName();
            $t=time();
            $img_name="{$userId}-{$t}-{$filename}";
            $filePath="storage/uploads/{$img_name}";

            $data['image']=$filePath;

            $file->storeAs('uploads',$img_name,'public');

            $oldFile=$request->input('file_path');
            File::delete($oldFile);

            Product::where('user_id','=',$userId)->where('id','=',$request->id)->update($data);
        }else if($id){
            Product::where('user_id','=',$userId)->where('id','=',$id)->update(['unit'=>$request->unit]);
            return $id;
        }else{
            $data=[
                'category_id'=>$request->category_id,
                'name'=>$request->name,
                'price'=>$request->price,
                'unit'=>$request->unit
            ];
            Product::where('user_id','=',$userId)->where('id','=',$request->id)->update($data);
        }
        return response()->json([
            'status' => "success",
            'message' => "Product Updated Successfully"
        ],200);
     }catch(Exception $e){
        return response()->json([
            'status' => "failed",
            'message' => "Product Updation Failed"
        ]);

     }
    }

    public function deleteProduct(Request $request){
        $userId=$request->header('id');
        $oldImage=$request->input('file_path');
        File::delete($oldImage);
        Product::where('user_id','=',$userId)->where('id','=',$request->id)->delete();
        return response()->json([
            'status' => "success",
            'message' => "Product Deleted Successfully"
        ],200);
    }

    public function productById(Request $request){
        $userId=$request->header('id');
        return Product::where('user_id','=',$userId)->where('id','=',$request->id)->first();
    }

    public function productPage(Request $request){

        return view('pages.dashboard.product-page');
    }
}
