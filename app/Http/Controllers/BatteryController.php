<?php

namespace App\Http\Controllers;

use App\Models\battery;
use App\Models\company;
use App\Models\Own;
use Illuminate\Http\Request;

class BatteryController extends Controller
{
    public function Add_Battery()
    {

        $userId = auth()->id();

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active)

        {
        return view('company.Add_Battery');
        }
    else
    {
        return redirect()->back();
    }
}
/***************************************************************************** */

    public function create_battery(Request $request)
    {

        $userId = auth()->id();

        $company = company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active)

        {

        $data = new battery;

        $data->name = $request->title;

        $data->price = $request->price;

        $data->quantities = $request->quantities;

        $data->capacity = $request->capacity;

        $data->type	 = $request->type;

        $image=$request->image;

        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('Battery',$imagename);

            $data->image=$imagename;
        }

        $data->save();

        $own = new Own;
        $own->companies_id = $company->id;
        $own->battery_id = $data->id;
        $own->save();

        return redirect()->back();
    }
    }

/****************************************************************************** */
public function View_Battery()
{
    $userId = auth()->id();
    $user = auth()->user();

    if ($user->usertype == 'admin') {

        $data = Battery::all();
        return view('admin.View_Battery', compact('data'));
    } elseif ($user->usertype == 'company') {

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {
            $data = Battery::whereHas('owns', function($query) use ($company) {
                $query->where('companies_id', $company->id);
            })->with('companies')->get();

            return view('company.View_Battery', compact('data'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to view this page.');
        }
    } else {
        return redirect()->back()->with('error', 'You are not authorized to view this page.');
    }
}


/********************************************************************************* */
    public function Delete_Battery($id)
    {
        $data=battery::find($id);

        if ($data)
        {
            $userId = auth()->id();

            $company = Company::where('user_id', $userId)->first();

            if ($company && $company->user->is_active)

        {

        $data->delete();
        return redirect()->back();
        }
        else
        {
            return redirect()->back();
        }
        }
    }

/******************************************************************************* */
    public function Update_Battery($id)
    {
        $data=battery::find($id);
        return view('company.Update_Battery',compact('data'));
    }

/********************************************************************************** */
    public function edit_battery(Request $request, $id)
    {
        $data=battery::find($id);

        if ($data)
        {
        $userId = auth()->id();

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {

        $data->name = $request->title;

        $data->price = $request->price;

        $data->quantities = $request->quantities;

        $data->capacity = $request->capacity;

        $data->type	 = $request->type;

        $image=$request->image;

        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('Battery',$imagename);

            $data->image=$imagename;
        }

        $data->save();

        return redirect()->back();
    }
    }
    }

/***************************************************************************** */
    public function showBatteryPage()
    {
        $data = battery::all();

        return view('home.Battery', compact('data'));
    }



    public function showBatteryDetails($id)
    {
        $battery = battery::find($id);

        if ($battery) {
            return view('home.battery_details', compact('battery'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
}
