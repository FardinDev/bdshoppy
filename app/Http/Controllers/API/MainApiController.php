<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\CategoryResource;
use Validator;

use App\ProductCategory as Category;

class MainApiController extends Controller
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
}
