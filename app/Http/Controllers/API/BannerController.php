<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\BannerResource;
use Validator;
use Illuminate\Validation\Rule;

use App\Banner as Banner;

class BannerController extends Controller
{
    public $secretKey;

   
    public function __construct(){
        $this->secretKey = config('credentials.api_key'); 
      
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
}
