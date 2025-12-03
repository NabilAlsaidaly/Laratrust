<?php

namespace App\Http\Controllers;

use App\Models\inverter;
use Illuminate\Http\Request;

use App\Models\User;
use App\Mode\contact;
use App\Models\battery;
use App\Models\Categories;
use App\Models\company;
use App\Models\contact as ModelsContact;
use App\Models\message;
use App\Models\solar_panel;
use App\Models\Technician;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function index()
    {
        if (Auth::id())
        {
            $usertype=Auth()->user()->usertype;

            if($usertype=='user')
            {
                $data1 = Inverter::all();
                $data2 = battery::all();
                $data3 = solar_panel::all();
                $data4 = Technician::all();
                $data5 = Categories::all();
                $data6 = company::all();
                return view('home.welcome',compact('data1','data2','data3','data4','data5','data6'));
            }
           else if($usertype=='admin')
            {
                return view('admin.index');
            }
            else if($usertype=='company')
            {
                return view('company.indexx');
            }
        }
    }

    public function home()
    {
        return view('home.welcome');
    }

    public function Provide(Request $request)
        {
        if (!Auth::check()) {
            return back()->withErrors(['Message'=>'You Must To Login First']);
        }
        $contact = new ModelsContact;

        $contact->name = $request->name;
        $contact->website = $request->website;
        $contact->phone = $request->phone;
        $contact->location = $request->location;
        $contact->comm_id = $request->comm_id;
        $contact->combank_id = $request->combank_id;
        $contact->user_id = Auth::id();
        $contact->save();
        return redirect()->back()->with('Message', 'Your Request Has Been Send Successfully.');
    }

    public function contact(Request $request)
    {
    if (!Auth::check()) {
        return back()->withErrors(['Message'=>'You Must To Login First']);
    }

    $message =new message;
    $message->message=$request->message;
    $message->user_id = Auth::id();
    $message->save();
    return redirect()->back()->with('Message', 'Your Message Has Been Send Successfully.');
}
}
