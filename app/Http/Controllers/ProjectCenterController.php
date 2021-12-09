<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsCenter;
use Illuminate\Support\Facades\Validator;

class ProjectCenterController extends Controller
{
   public function showProjectsCenter (Request $request)
   {
    
      return ProjectsCenter::all();
   }
   public function createProjectsCenter (Request $request)
   {
    $rules = [
                'name' => 'required|unique:Projects_Centers'
                ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails())
    {
        return  $validator->messages();
    }
    else{
       
    $projectsCenter = new ProjectsCenter;
    $projectsCenter->name = $request->input('name');
    $projectsCenter->save();
    return response()->json('Project has been created ' , 201);

    }
   }
   public function updateProjectsCenter(Request $request ,$id)
   {
    
    $projectsCenter = ProjectsCenter::find($id);
    if (ProjectsCenter::where('id', $id)->exists()) {

        $projectsCenter->name = $request->input('name' );
        $projectsCenter->save();

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
   public function deleteProjectsCenter(Request $request ,$id)
   {
   
    if(ProjectsCenter::where('id', $id)->exists()) {
        $Project_center = ProjectsCenter::find($id);
        $Project_center->delete();
        return response()->json([
           "message" => "Record deleted"
       ], 202);
   }
   }
}
