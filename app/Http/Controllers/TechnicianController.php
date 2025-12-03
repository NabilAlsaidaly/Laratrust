<?php

namespace App\Http\Controllers;

use App\Models\company;
use App\Models\Own;
use App\Models\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function Add_Technician()
    {

        $userId = auth()->id();

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active)
        {

        return view('company.Add_Technician');
        }
        else
        {
            return redirect()->back();
        }
}

/************************************************************** */
    public function create_technician(Request $request)
    {
        $userId = auth()->id();

        $company = company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active)
        {

        $tech = new Technician;

        $tech->companies_id = $company->id;

        $tech->name = $request->title;

        $tech->phone = $request->phone;

        $tech->info = $request->info;

        $image = $request->image;

        if($image) {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('Technician', $imagename);
            $tech->image = $imagename;
        }

        $tech->save();

        return redirect()->back();
    }
}

/****************************************************************** */
    public function View_Technician()
    {

        $userId = auth()->id();

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {

        $data = $company->technicians()->get();

        return view('company.View_Technician', compact('data'));
    }
    else
    {
        return redirect()->back();
    }
    }
/************************************************************************ */
    public function Delete_Technician($id)
    {
        $data=Technician::find($id);

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

/***********************************************************************8 */
    public function Update_Technician($id)
    {
        $data=Technician::find($id);

        if ($data)
        {
            $userId = auth()->id();

            $company = Company::where('user_id', $userId)->first();

            if ($company && $company->user->is_active) {

        return view('company.Update_Technician',compact('data'));
    }
    else
    {
        return redirect()->back();
    }
    }
    }

/************************************************************************** */
    public function edit_technician(Request $request, $id)
    {
        $data=Technician::find($id);

        if ($data)
        {
           $userId = auth()->id();

           $company = Company::where('user_id', $userId)->first();

           if ($company && $company->user->is_active) {

        $data->name = $request->title;

        $data->phone = $request->phone;

        $data->info = $request->info;

        $image=$request->image;

        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('Technician',$imagename);

            $data->image=$imagename;
        }

        $data->save();

        return redirect()->back();
    }
        }
    }

/****************************************************************************** */
    public function showTechnicianPage()
    {
        $data = Technician::all();

        return view('home.Technicain', compact('data'));
    }


    public function showTechDetails($id)
    {
        $tech = Technician::find($id);

        if ($tech) {
            return view('home.tech_details', compact('tech'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
}
