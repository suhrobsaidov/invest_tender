<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Http\Middleware\Check;
use Tymon\JWTAuth\JWTAuth;
use App\Models\User;
use App\Models\Subscribers;


class OrdersController extends Controller
{
  
  
   public function myOrders(Request $request)
   
   {
    
      $orders = new Orders();
      $orders['users_id'] = $request->user()->id;
      $orders->anouncements_id = $request->input('anouncements_id');
    
      $orders->save();
     
      return response()->json([
         "message" => "Record has been added"
     ], 200);
   }

    public function deleteOrders(Request $request ,$id)
    {
    
      if(Orders::where('id', $id)->exists()) {
         $orders = Orders::find($id);
         $orders->delete();
         return response()->json([
            "message" => "Record deleted"
        ], 202);
    }
   }
   public function all(Request $request)
   {
     
      return Orders::all();
   }


}
