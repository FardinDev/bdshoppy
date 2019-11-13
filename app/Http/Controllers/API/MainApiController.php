<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\BannerResource;
use App\Http\Resources\ProductResource;
use Validator;

use App\ProductCategory as Category;
use App\Banner as Banner;
use App\Product as Product;
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


    public function getBanners(Request $request){

        $validator = Validator::make($request->all(), [
            'secret_key' => [
                'required',
                Rule::in([$this->secretKey]),
            ]
            ]);
            
            if ($validator->fails()) {
                return response()->json(['status' => 'failed','message' => $validator->errors() ], 400);
            }

            $banners = Banner::all();

            return response()->json(['status' => 'success','banners' => BannerResource::collection( $banners ) ]);

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

            $offerProducts = Product::where('on_offer', 1)->with('category')->with('brand')->get();

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

            $allProducts = Product::with('category')->with('brand')->get();

            return response()->json(['status' => 'success', 'count' => sizeof($allProducts), 'all_products' =>  ProductResource::collection( $allProducts )  ]);

    }
}
