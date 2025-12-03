<?php

namespace App\Http\Controllers;

use App\Models\inverter;
use App\Models\company;
use App\Models\Own;
use Illuminate\Http\Request;

class InverterController extends Controller
{
    public function Add_Inverter()
    {
        $userId = auth()->id();

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active)
        {
            return view('company.Add_Inverter');
        }

        else
        {
            return redirect()->back();
        }
    }
/**************************************************************************** */

    public function create_inverter(Request $request)
    {
        $userId = auth()->id();

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active)
        {
            $inverter = new Inverter;

            $inverter->name = $request->title;

            $inverter->price = $request->price;

            $inverter->quantities = $request->quantities;

            $inverter->capacity = $request->capacity;

            $inverter->description = $request->description;

            $image = $request->image;

            if ($image)
            {
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image->move('inverter', $imagename);
                $inverter->image = $imagename;
            }

            $inverter->save();

            $own = new Own;
            $own->companies_id = $company->id;
            $own->inverter_id = $inverter->id;
            $own->save();

            return redirect()->back();
    }
    }

/**************************************************************************** */
    public function View_Inverter()
    {
        $userId = auth()->id();
        $user = auth()->user();

        if ($user->usertype == 'admin') {

            $data = inverter::all();
            return view('admin.View_Inverter', compact('data'));
        } elseif ($user->usertype == 'company') {

            $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {

            $data = Inverter::whereHas('owns', function($query) use ($company) {

                $query->where('companies_id', $company->id);

            })->get();

            return view('company.View_Inverter', compact('data'));
        }

        else
        {
            return redirect()->back();
        }
    }
    }
/**************************************************************************** */
    public function Delete_Inverter($id)
    {
        $data = Inverter::find($id);

        if ($data)
        {
            $userId = auth()->id();

            $company = Company::where('user_id', $userId)->first();

            if ($company && $company->user->is_active) {

                $data->delete();

                return redirect()->back();
            }
            else
            {
                return redirect()->back();
            }
    }
    }
/**************************************************************************** */

    public function Update_Inverter($id)
    {
        $data = Inverter::find($id);

        if ($data)
        {
            $userId = auth()->id();

            $company = Company::where('user_id', $userId)->first();

            if ($company && $company->user->is_active) {

                return view('company.Update_Inverter', compact('data'));

            }
            else
            {
                return redirect()->back();
            }
    }
    }

/**************************************************************************** */
    public function edit_inverter(Request $request, $id)
    {
        $data = Inverter::find($id);

        if ($data)
         {
            $userId = auth()->id();

            $company = Company::where('user_id', $userId)->first();

            if ($company && $company->user->is_active) {

                $data->name = $request->title;

                $data->price = $request->price;

                $data->quantities = $request->quantities;

                $data->capacity = $request->capacity;

                $data->description = $request->description;

                $image = $request->image;

                if ($image)
                {
                    $imagename = time() . '.' . $image->getClientOriginalExtension();

                    $request->image->move('inverter', $imagename);

                    $data->image = $imagename;

                }

                $data->save();

                return redirect()->back();
    }
    }
    }
/**************************************************************************** */

    public function showInverterPage()
    {
        $data = Inverter::all();

        return view('home.inverter', compact('data'));
    }

    public function showInverterDetails($id)
    {
        $inverter = inverter::find($id);

        if ($inverter) {
            return view('home.inverter_details', compact('inverter'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
}
