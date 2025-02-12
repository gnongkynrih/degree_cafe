<?php

namespace App\Http\Controllers;

use App\Mail\SendHelloMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send(Request $request)
    {
        try{
            $to = $request->email;
            $data = [
                "name" => "John Doe",
                'subject' => 'Welcome Email'
            ];
            Mail::to($to)->send(new SendHelloMail($data));  
        return redirect()->route('sale.pos')->with('success','Email sent successfully');
    }
    catch(\Exception $e){
        throw $e;
    }
        }
}
