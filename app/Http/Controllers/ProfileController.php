<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Models\User;
use App\Models\Photo;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Http\Middleware\Check;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;
use App\Mail\Users;

class ProfileController extends Controller
{

    public function profile(Request $request ,$id)
{

            $subscribers_profile = Subscribers::find($id);
           
            return $subscribers_profile;


   /* else{
        return response()->json([
            "message" => "Please log in"
        ], 401);
    }*/
    }
   

    public function update(Request $request ,$id)
    {
        $subscribers = Subscribers::find($id);
        if (Subscribers::where('id', $id)->exists()) {

            $subscribers->name = $request->input('name',$subscribers->name);
            $subscribers->last_name = $request->input('last_name',$subscribers->last_name);
            $subscribers->middle_name = $request->input('middle_name',$subscribers->middle_name);
            $subscribers->company_name = $request->input('company_name',$subscribers->company_name);
            $subscribers->division = $request->input('division',$subscribers->division);
            $subscribers->company_country = $request->input('company_country',$subscribers->company_country);
            $subscribers->inn = $request->input('inn',$subscribers->inn);
            $subscribers->phone = $request->input('phone',$subscribers->phone);
            $subscribers->email = $request->input('email',$subscribers->email);
            $subscribers->town = $request->input('town', $subscribers->town);
            $subscribers->postal_code = $request->input('postal_code', $subscribers->postal_code);
            $subscribers->address_line1 = $request->input('address_line1', $subscribers->address_line1);
            $subscribers->address_line2 = $request->input('address_line2', $subscribers->address_line2);
            $subscribers->address_line3 = $request->input('address_line3', $subscribers->address_line3);
            $subscribers->update();
          
         
            
          
        //    if ($image = $request->file('image')) {
        //         $destinationPath = 'public/storage/images';
        //         $filename = $request->file('image')->getClientOriginalName();
        //         $profileImage =$filename . "." . $image->getClientOriginalExtension();
        //         $image->move($destinationPath, $profileImage);
        //         $subscribers->image = $profileImage;
               
        //     }
        //     else{
        //         $subscribers->image = $subscribers->image;
        //     }

       


            return response()->json([
                "message" => "Record has been updated"
            ], 200);
        }
        else{
            return response()->json([
                "message" => "Record not found"
            ], 404);
        }
    }
    public function updatePassword(Request $request , $id)
    { 
        $user = User::find($id);
        if (User::where('id', $id)->exists()) {

         $user->email = $request->input('email');
         $user->password = bcrypt($request->password);
         $user->save();
         return response()->json('Password has been Updated' , 201);

         }
         else{
             return response()->json('User not found' , 404 );
         }
    
   
    

    


}
}