<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectCenter;

class ProjectCenterController extends Controller
{
   public function showProjectsCenter ()
   {
      return ProjectCenter::all();
   }
   public function createProjectsCenter (Request $request)
   {
       
    $projectCenter = new Project_center;
    $projectsCenter->name = $request->input('name');


   }
   public function updateProjectsCenter($id)
   {
    $projectsCenter = Project_center::find($id);
    if (Project_center::where('id', $id)->exists()) {
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
   public function deleteProjectsCenter($id)
   {
    if(Project_center::where('id', $id)->exists()) {
        $Project_center = Project_center::find($id);
        $Project_center->delete();
        return response()->json([
           "message" => "Record deleted"
       ], 202);
   }
   }
}
