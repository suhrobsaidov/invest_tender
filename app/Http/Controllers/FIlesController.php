<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FIlesController extends Controller
{
    public function store(StoreFileRequest $request)
    {
        $fileName = auth()->id() . '_' . time() . '.'. $request->file->extension();  

        $type = $request->file->getClientMimeType();
        $size = $request->file->getSize();

        $request->file->move(public_path('file'), $fileName);

        File::create([
            'user_id' => auth()->id(),
            'name' => $fileName,
            'type' => $type,
            'size' => $size
        ]);

        return response()->json('OK' ,200);
    }
}
