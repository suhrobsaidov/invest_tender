<?php
namespace App\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\ProjectsCenter;
use App\Models\User;
use App\Models\Subscribers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;






class ProjectsController extends Controller
{
    public function showProjects(Request $request ,$id)
    {
        $user = User::where('role' , '=' , 'anouncer')->get();
        return $user;
    }
    public function createProjects(Request $request , Projects $projects , User $user)
    {
        $user = User::create([
         'email' => $request->input('email'),
         'password' => bcrypt($request->password),
        ]);
    
        $projects = Projects::create([
          'name' => $request->input('name'),
         
        ]);
        return $user . $projects;
         
        return response()->json([
            "message" => "Success"
        ], 201);
    }
       
    
    public function updateProjects(Request $request ,$id)
    {
     
       
        $projects = User::find($id);
        $projects->email = $request->input('email',$projects->email);
        $projects->password = bcrypt($request->password);
        $projects->role =  'anouncer';
        $projects->save();
        return response()->json([
            "message" => "Success"
        ], 201);
      }
    

    public function deleteProjects(Request $request ,$id)
    {
       
        $projects = User::find($id);
        $projects->delete();
        return response()->json([
            "message" => "Success"
        ], 201);
      
    }
    public function projects(Request $request ,$id)
    {
        
            return "ok";
      

     

    }
}
