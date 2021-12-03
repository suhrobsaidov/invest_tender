<?php
namespace App\Http\Controllers;


use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Projects;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;






class ProjectsController extends Controller
{
    public function showProjects()
    {
        return Projects::all();
    }
    public function createProjects()
    {
        $projects = new Projects();
        $prjects->project_name = $request->input('project_name');
        $prjects->anouncements_id = $request->input('anouncements_id');
        $projects->save();
        
        return response()->json([
            "message" => "Success"
        ], 201);
      
       
    }
    public function updateProjects($id)
    {
       
        $projects = Projects::find($id);
        $projects->name = $request->input('projects_mame',$projects->name);
        $projects->anouncements_id = $request->input('anouncements_id');
        $projects->save();
        return response()->json([
            "message" => "Success"
        ], 201);
      }
    

    public function deleteProjects()
    {
        $projects = Projects::find($id);
        $projects->delete();
        return response()->json([
            "message" => "Success"
        ], 201);
      
    }
}
