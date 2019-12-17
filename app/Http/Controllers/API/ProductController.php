<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Validator;
use Illuminate\Validation\Rule;

use App\Product as Product;
class ProductController extends Controller
{
    public $secretKey;

   
    public function __construct(){
        $this->secretKey = config('credentials.api_key'); 
      
    }

    public function getOfferProducts(Request $request){

        $validator = Validator::make($request->all(), [
            'secret_key' => [
                'required',
                Rule::in([$this->secretKey]),
            ]
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'failed','message' => $validator->errors() ], 400);
            }

            $offerProducts = Product::where('on_offer', 1)->with('category')->with('brand')->latest()->get();

            return response()->json(['status' => 'success', 'count' => sizeof($offerProducts), 'offer_products' =>  ProductResource::collection( $offerProducts )  ]);

    }

    public function getAllProducts(Request $request){

        $validator = Validator::make($request->all(), [
            'secret_key' => [
                'required',
                Rule::in([$this->secretKey]),
            ]
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'failed','message' => $validator->errors() ], 400);
            }

            $allProducts = Product::with('category')->with('brand')->latest()->get();
              
            return response()->json(['status' => 'success', 'count' => sizeof($allProducts), 'all_products' =>  ProductResource::collection( $allProducts )  ]);

    }
}
