<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;

class FIlesController extends Controller
{
    // public function store(StoreFileRequest $request)
    // {
    //     $fileName = auth()->id() . '_' . time() . '.'. $request->file->extension();  

    //     $type = $request->file->getClientMimeType();
    //     $size = $request->file->getSize();

    //     $request->file->move(public_path('file'), $fileName);

    //     File::create([
    //         'user_id' => auth()->id(),
    //         'name' => $fileName,
    //         'type' => $type,
    //         'size' => $size
    //     ]);

    //     return response()->json('OK' ,200);
    // }
     public function fileUpload(Request $request){
        // $req->validate([
        // 'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
        // ]);

        // $fileModel = new File;

        // if($req->file()) {
        //     $fileName = time().'_'.$req->file->getClientOriginalName();
        //     $filePath = $req->file('file')->storeAs('files', $fileName, 'public');

        //     $fileModel->name = time().'_'.$req->file->getClientOriginalName();
        //     $fileModel->file_path = '/storage/' . $filePath;
        //     $fileModel->save();

        //     return back()
        //     ->with('success','File has been uploaded.')
        //     ->with('file', $fileName);
        // }

        $validatedData = $request->validate([
            'file' => 'required|pdf|max:2048',
    
           ]);
    
           $name = $request->file('file')->getClientOriginalName();
    
           $path = $request->file('file')->store('public/files');
    
    
           $save = new File;
    
           $save->name = $name;
           $save->path = $path;

        return response()->json('well done' ,200);
        
        
       
   }
}
