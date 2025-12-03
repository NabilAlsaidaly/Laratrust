<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\Own;
use App\Models\solar_panel;
use Illuminate\Http\Request;

class SolarController extends Controller
{
    public function Add_Solar()
    {
        $userId = auth()->id();

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {
            return view('company.Add_Solar');
        } else {
            return redirect()->back();
        }
    }
    /*********************************************************************** */

    public function create_solar(Request $request)
    {

        $userId = auth()->id();

        $company = company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {

            $data = new solar_panel;

            $data->name = $request->title;

            $data->price = $request->price;

            $data->quantities = $request->quantities;

            $data->capacity = $request->capacity;

            $data->description     = $request->description;

            $image = $request->image;

            if ($image) {
                $imagename = time() . '.' . $image->getClientOriginalExtension();

                $request->image->move('SolarPanel', $imagename);

                $data->image = $imagename;
            }

            $data->save();

            $own = new Own;
            $own->companies_id = $company->id;
            $own->solar_panel_id = $data->id;
            $own->save();

            return redirect()->back();
        }
    }

    /*********************************************************************** */
    public function View_Solar()
    {
        $userId = auth()->id();
        $user = auth()->user();

        if ($user->usertype == 'admin') {

            $data = solar_panel::all();
            return view('admin.View_Solar', compact('data'));
        } elseif ($user->usertype == 'company') {

            $company = Company::where('user_id', $userId)->first();
            if ($company && $company->user->is_active) {

                $data = solar_panel::whereHas('owns', function ($query) use ($company) {
                    $query->where('companies_id', $company->id);
                })->get();
                return view('company.View_Solar', compact('data'));
            } else {
                return redirect()->back();
            }
        }
    }

    /*************************************************************************** */
    public function Delete_Solar($id)
    {
        $data = solar_panel::find($id);

        if ($data) {
            $userId = auth()->id();

            $company = Company::where('user_id', $userId)->first();

            if ($company && $company->user->is_active) {

                $data->delete();
                return redirect()->back();
            }
        }
    }
    /*********************************************************************** */

    public function Update_Solar($id)
    {
        $data = solar_panel::find($id);
        return view('company.Update_Solar', compact('data'));
    }
    /*********************************************************************** */
    public function edit_solar(Request $request, $id)
    {
        $data = solar_panel::find($id);

        if ($data) {
            $userId = auth()->id();

            $company = Company::where('user_id', $userId)->first();

            if ($company && $company->user->is_active) {

                $data->name = $request->title;

                $data->price = $request->price;

                $data->quantities = $request->quantities;

                $data->capacity = $request->capacity;

                $data->description     = $request->description;

                $image = $request->image;

                if ($image) {
                    $imagename = time() . '.' . $image->getClientOriginalExtension();

                    $request->image->move('SolarPanel', $imagename);

                    $data->image = $imagename;
                }

                $data->save();

                return redirect()->back();
            }
        }
    }

    /*********************************************************************** */

    public function showSolarPage()
    {
        $data3 = solar_panel::all();

        return view('home.SPanel', compact('data3'));
    }



    
    public function showSolarDetails($id)
    {
        $solar = solar_panel::find($id);

        if ($solar) {
            return view('home.solar_details', compact('solar'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
}
