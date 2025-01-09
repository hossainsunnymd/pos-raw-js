<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function createCategory(Request $request)
    {

       try{
        $userId=$request->header('id');
        Category::create([
            'name'=>$request->name,
            'user_id'=>$userId
        ]);
        return response()->json([
            'status' => "success",
            'message' => "Category Created Successfully"
        ],201);
       }catch(Exception $e){
        return response()->json([
            'status' => "failed",
            'message' => "Category Creation Failed"
        ]);
       }
    }

    public function listCategory(Request $request){
        $userId=$request->header('id');
        return Category::where('user_id','=',$userId)->get();
    }

    public function updateCategory(Request $request){
        try{
            $userId=$request->header('id');
            $id=$request->input('id');
            Category::where('id','=',$id)->where('user_id','=',$userId)->update([
                'name'=>$request->name
            ]);
            return response()->json([
                'status' => "success",
                'message' => "Category Updated Successfully"
            ],201);
        }catch(Exception $e){
            return response()->json([
                'status' => "failed",
                'message' => "Category Updation Failed"
            ]);
        }
    }

    public function deleteCategory(Request $request){
        try{
            $userId=$request->header('id');
            $id=$request->input('id');
            Category::where('id','=',$id)->where('user_id','=',$userId)->delete();
            return response()->json([
                'status' => "success",
                'message' => "Category Deleted Successfully",
                'id'=>$id
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status' => "failed",
                'message' => "Category Deletion Failed"
            ]);
        }
    }

    public function categoryById(Request $request){
        $userId=$request->header('id');
        return Category::where('id','=',$request->id)->where('user_id','=',$userId)->first();
    }

    public function categoryPage(){
        return view('pages.dashboard.category-page');
    }

}
