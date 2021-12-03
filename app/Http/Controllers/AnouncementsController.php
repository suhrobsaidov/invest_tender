<?php

namespace App\Http\Controllers;

use App\Models\Anouncement;
use App\Models\Anouncements_translations;
use App\Models\Orders;
use App\Models\User;
use App\Models\File;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use App\Http\Requests\StoreFileRequest;

use App\Models\Favorites;

class AnouncementsController extends Controller
{

 
 
  public function allAnouncements()
  {
     
          return Anouncement::all();
      
     
  }
public function favorite()
{
  
$favorite = new Favorites;
 $favorite->users_id = $request->input('users_id');
 $favorite->anouncements_id = $request->input('anouncements_id');
 $favorite->save();
 return $favorite;
 

}
public function showFavorites($id)
{
  $favorites = Favorites::where("id", $id)->get();
  return $favorites;
}
public function createFavorites(Request $request)
{

  $favorites = new Favorites();
  $favorites['users_id'] = $request->user()->id;
  $favorites->anouncements_id = $request->input('anouncements_id');
  $favorites->save();
  return $favorites;
}
public function deleteFavorites($id)
{
  
  $favorites = Favorites::find($id)->delete();
  return response()->json("Success", 200);
  }
 


  public function create(Request $request )
  {
    
          
        $rules = [
                // 'files' => 'required|mimes:.pdf',
                // 'tender_title' => 'required|string|min:1|max:100',
              //  'role' => 'required'
               
                
    
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return  $validator->messages();
            }
            else{
        
         
        
            $user =$request->user()->role;
           
             
            
            
              if($request->user()->role === 'anouncer')
              {
        
              $anouncements = new Anouncement();         
              $anouncements->name = $request->input('name');
              $anouncements->number_of_lots = $request->input('number_of_lots');
              $anouncements->type_of_procurement = $request->input('type_of_procurement');
              $anouncements->description = $request->input('description');
              $anouncements->price = $request->input('price');
              $anouncements->tender_title = $request->input('tender_title');
              $anouncements->open_date = $request->input('open_date');
              $anouncements['users_id'] = $request->user()->id;
              $anouncements->save();
            
             
    
              
              return response()->json([
                  "message" => "Success"
              ], 201);
           
                
              }
              else{
                      return response()->json('This is not allowed to you' , 403);
              }
            }
         
        
       
  
        }
      
  public function update(Request $request ,$id)
  {
        $anouncements = Anouncement::find($id);
        if (Anouncement::where('id', $id)->exists()) {
        
          $anouncements = new Anouncement();         
          $anouncements->name = $request->input('name');
          $anouncements->number_of_lots = $request->input('number_of_lots');
          $anouncements->type_of_procurement = $request->input('type_of_procurement');
          $anouncements->description = $request->input('description');
          $anouncements->price = $request->input('price');
          $anouncements->tender_title = $request->input('tender_title');
          $anouncements->open_date = $request->input('open_date');
          $anouncements['users_id'] = $request->user()->id;
          $anouncements->save();
         

          
          return response()->json([
              "message" => "Success"
          ], 201);
        }
        else{
                return response()->json([
                    "message" => "Record not found"
                ], 404);
            }

      

  }
 
 
}
