<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
  public function index()
  {

  }

  public function createAnouncer(Request $request)
  {
    $user =$request->user()->role;
    if($request->user()->role === 'admin')
    {
    $user =  new User();
    $user->email = $request->input('email');
    if(User::where('email', $request->input('email'))->exists())
    {
      return response()->json("This login is busy" ,403);
    }
    $user->password =  bcrypt($request->password);
    $user->role = 'anouncer';
    $user->save(); 
    return $user;
     }
    
    else{
      return response()->json('You dont have permissions',403);
    }
   
  }
  public function updateAnouncer(Request $request ,$id)
  {
       $user =$request->user()->role;
    if($request->user()->role === 'admin'){
          $user = User::find($id);
    if(User::where('id', $id)->exists()) {
            $user->email = $request->input('email');
              $user->password =  bcrypt($request->password);
              $user->save();
            return response()->json([
      "message" => "User wasupdated"]);
    
    } else {
      return response()->json([
          "message" => "User was not found"
      ], 404);
    }
  }else{
     return response()->json('Not allowed' , 405);
  }

  } 
  public function deleteAnouncer(Request $request ,$id)

  {
    $user =$request->user()->role;
    if($request->user()->role === 'admin')
    {
    if(User::where('id', $id)->exists()) {
    $user = User::find($id);
        $user->delete();
        return response()->json([
            "message" => "User has been deleted" 
        ], 201);
      
    }
    else {
      return response()->json([
          "message" => "User was deleted or missing"
      ], 404);
  }
}
else{
   return response()->json('Not allowed' , 405);
}

      
  
}
}