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
use Illuminate\Support\Str;






class ProjectsController extends Controller
{
    public function showProjects($id)
    {
        $projects = Projects::where("project_center_id", $id)->join("users","users.id","=","projects.users_id")->select("projects.*","users.email")->get();
        
        return $projects;
    }
    public function createProjects(Request $request)
    {
       
        $user = new User();
        $user->email = $request->input('email');
        $user->role = 'anouncer';
        $user->password = bcrypt(Str::random(10));
        $user->save();

       $project= new Projects;
       $project->name = $request->input('project_name');
       $project->project_center_id = $request->input('project_center_id');
       $project->users_id = $user->id;
       
       $project->save();
       
         
        return response()->json([
            "message" => "Success"
        ], 201);
    
}  
    
    public function updateProjects(Request $request ,$id)
    {
     
        $projects = Projects::find($id);
        if($projects === null){
            return response()->json(["message" => "Not found"],404);
        }
        else{
            $user = User::find($projects->users_id);
            $user->email = $request->input('email',$projects->email);
            $projects->name = $request->input('name',$projects->name);
            $user->save();
            $projects->save();
            return response()->json([
                "message" => "Success"
            ], 201);
        }
      }
    

    public function deleteProjects($id)
    {
        $projects = Projects::find($id);
        if($projects === null){
            return response()->json(["message" => "Not found"],404);
        }
        else{
            $user = User::find($projects->users_id);
            $projects->delete();
            $user->delete();
            return response()->json([
                "message" => "Success"
            ], 201);
        }
      
    }
}
