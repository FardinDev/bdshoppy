<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;

use Validator;
use Illuminate\Validation\Rule;

use App\ProductCategory as Category;
class CategoryController extends Controller
{
    public $secretKey;

   
    public function __construct(){
        $this->secretKey = config('credentials.api_key'); 
      
    }

    public function getCategoryList(Request $request){

        $validator = Validator::make($request->all(), [
            'secret_key' => [
                'required',
                Rule::in([$this->secretKey]),
            ]
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'failed','message' => $validator->errors() ], 400);
            }

            $category = Category::all();

            return response()->json(['status' => 'success','categories' => CategoryResource::collection( $category ) ]);


    }

    public function getCategoryWiseProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'secret_key' => [
                'required',
                Rule::in([$this->secretKey]),
            ],
            'category_id' => 'required',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'failed','message' => $validator->errors() ], 400);
            }

            $id = $request->input('category_id');

            $category = Category::with('products')->find($id);


            return response()->json(['status' => 'success','category' => new CategoryResource( $category ), 'products' => ProductResource::collection( $category->products ) ]);

    }
}
