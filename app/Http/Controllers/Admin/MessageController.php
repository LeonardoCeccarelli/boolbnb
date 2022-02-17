<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index() {
        $message = Message::all();
        return view("admin.message.index", compact('message'));
    }
}
