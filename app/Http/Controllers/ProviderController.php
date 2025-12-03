<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\data;
use App\Models\contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderController extends Controller
{
    public function View_Provider()
    {
        $data = contact::all();

        return view('admin.View_Provider',compact('data'));
    }

    public function Delete_Provider($id)
    {
        $data=contact::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function Accept_Provider($id)
    {

        $contact = Contact::findOrFail($id);

        $data = new Company;
        $data->name = $contact->name;
        $data->website = $contact->website;
        $data->phone = $contact->phone;
        $data->location = $contact->location;
        $data->comm_id = $contact->comm_id;
        $data->combank_id = $contact->combank_id;
        $data->user_id = $contact->user_id;
        $data->save();
        $contact->delete();
        return redirect()->back();
}

}
