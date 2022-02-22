<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\SendNewMail;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function onFormSubmit(Request $request)
    {
        $request->validate([
            "name" => "required|max:255",
            "email" => "required|email:rfc,dns,strict,spoof,filter|max:255",
            "object" => "required|max:255",
            "content" => "required|max:5000",
            "id" => "required",
        ]);

        $data = $request->all();

        // Mail::to(env("MAIL_CONTACT_DESTINATION"))->send(new SendNewMail($data));

        $newMessage = new Message();
        $newMessage->fill($data);
        $newMessage->apartment_id = $data['id'];
        $newMessage->save();
    }
}
