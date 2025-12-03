<?php

namespace App\Http\Controllers;

use App\Models\message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function View_Messages()
    {
        $data = message::all();

        return view('admin.View_Messages',compact('data'));
    }

    public function Delete_Messages($id)
    {
        $data=message::find($id);
        $data->delete();
        return redirect()->back();
    }
}
