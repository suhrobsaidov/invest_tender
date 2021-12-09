<?php

namespace App\Http\Controllers;

use App\Models\Anouncement;
use App\Models\Anouncements_translations;
use App\Models\Orders;
use App\Models\User;
use App\Models\Projects;
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

 
  public function __construct()
  {
      $this->middleware('auth:api');
  }

 
  public function allAnouncements()
  {
     
          return Anouncement::all();
      
     
  }
  public function myAnouncements()
  {
     //
  }
public function favorite()
{
  $header = $request->header('Authorization');
  
$favorite = new Favorites;
 $favorite->users_id = $request->input('users_id');
 $favorite->anouncements_id = $request->input('anouncements_id');
 $favorite->save();
 return $favorite;
 

}
public function showFavorites($id)
{
  
  $header = $request->header('Authorization');
  $favorites = Favorites::where("id", $id)->get();
  return $favorites;
}
public function createFavorites(Request $request)
{
  $header = $request->header('Authorization');

  $favorites = new Favorites();
  $favorites['users_id'] = $request->user()->id;
  $favorites->anouncements_id = $request->input('anouncements_id');
  $favorites->save();
  return $favorites;
}
public function deleteFavorites(Request $request ,$id)
{
  $header = $request->header('Authorization');

  $favorites = Favorites::find($id)->delete();
  return response()->json("Success", 200);
  }
 


  public function create(Request $request )
  {
      $header = $request->header('Authorization');
    
          
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
    
          //  $user =$request->user()->role;
          //       if($request->user()->role === 'anouncer')
          //       {
        
            $anouncements = new Anouncement;
              $projects_id = Projects::where('id' , $request->input('projects_id'))->value('id');
              $anouncements['name'] = $request->input('name');
              $anouncements['number_of_lots'] = $request->input('number_of_lots');
              $anouncecments['procurement_method'] = $request->input('procurement_method');
              $anouncements['type_of_procurement'] = $request->input('type_of_procurement');
              // $anouncements['description'] = $request->input('description');
              $anouncements['price'] = $request->input('price');
              $anouncements['tender_title'] = $request->input('tender_title');
              $anouncements['open_date'] = $request->input('open_date') ; 
              $projects_id = Projects::where('id' , $request->input('projects_id'))->value('id');         
              $anouncements['projects_id'] = $projects_id;
              $anouncements['users_id'] = auth()->user()->id;
              $pdf_decoded = base64_decode (explode("base64,",$request->input('file'))[1]);
              //Write data back to pdf file
              $file_name = sha1(uniqid(time(), true));
              $pdf = fopen ('test.pdf','w');
              fwrite ($pdf,$pdf_decoded);
              //close output file
              fclose ($pdf);
              $anouncements->file = $file_name;
               }
               
              // $path = $request->file('file')->getRealPath();
              // $file = file_get_contents($path);
              // $base64 = base64_encode($file);
              // $anouncements->file = $base64;
              $anouncements['project_center_anouncement_id'] = $request->input('project_center_anouncement_id');
             
             $anouncements->save();
            
       
    
              
              return response()->json([
                  "message" => "Success"
              ], 201);
           
                
                }
            //     else{
            //            return response()->json('This is not allowed to you' , 403);
            //      }
            //  }
         
        
         
  
        
      
  public function update(Request $request ,$id)
  {
    $header = $request->header('Authorization');
        $anouncements = Anouncement::find($id);
        if (Anouncement::where('id', $id)->exists()) {
        
          $anouncements->name = $request->input('name');
              $anouncements->number_of_lots = $request->input('number_of_lots');
              $anouncecments['procurement_method'] = $request->input('procurement_method');
              $anouncements->type_of_procurement = $request->input('type_of_procurement');
              $anouncements->description = $request->input('description');
              $anouncements->price = $request->input('price');
              $anouncements->tender_title = $request->input('tender_title');
              $anouncements->open_date = $request->input('open_date');
              $anouncements['users_id'] = $request->user()->id;
              $anouncements['projects_id'] = $request->input('projects_id');
              $anouncements['project_center_anouncement_id'] = $request->input('project_center_anouncement_id');
              $file = $request->input('file');
              $filedate = file_get_contents($anouncements->file);
              $base64= base64_decode($filedate);
              $anouncements->file = $base64;


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

  public function applied()
  {
    $user = User::where('role' , '=' , 'subscribers')->get();
    $anouncements_subscribers = Anouncement::where('users_id' ,$user)->get();
    return $anouncements_subscribers;


   
    

  }
 
 
}
