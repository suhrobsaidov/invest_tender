<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payments;
use App\Models\Anouncements;
use App\Models\Subscribers;



class PaymentsController extends Controller
{
   

    public function showPayments()
    {
        //
    }
    public function createPayment(Request $request)
    {
       $payments = new Payments;
       $payments['anouncements_id']= $request->input('anouncements_id');
       $payments['users_id'] = $request->user()->id;
     
       $payments->status= $request->input('status');
       $payments->files =$request->input('files');

    //     if ($image = $request->file('image')) {
    //      $destinationPath = 'public/storage/images';
    //      $paymentsImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
    //      $image->move($destinationPath, $paymentsImage);
    //      $subscribers->image = $paymentsImage;
      
    //  }
   
        $payments->save();
            
    return response()->json('Accepted' , 201);


    }
    public function updatePayments($id)
    {
       //
    }
    public function  deletePayments($id)
    {
        if (Payments::where('id', $id)->exists()) {
            $payments = Payments::find($id);
            $payments->delete();
            return response()->json([
                "message" => "Record deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Record was deleted or missing"
            ], 404);
        }
    }
}
