<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inverter;
use App\Models\Battery;
use App\Models\Categories;
use App\Models\SolarPanel;
use App\Models\Company;
use App\Models\solar_panel;

class ProductController extends Controller
{

    public function AllProduct()
{
    $userId = auth()->id();
    $user = auth()->user();

    if ($user->usertype == 'admin') {
        $inverters = Inverter::with('companies')->get();
        $batteries = Battery::with('companies')->get();
        $solarPanels = solar_panel::with('companies')->get();
        $categories = Categories::with('companies')->get();
        $companies = Company::all(); // جلب قائمة الشركات
        return view('admin.View_All', compact('inverters', 'batteries', 'solarPanels', 'companies','categories'));
    }


    elseif ($user->usertype == 'company') {
        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {
            $inverters = Inverter::whereHas('owns', function($query) use ($company) {
                $query->where('companies_id', $company->id);
            })->get();

            $batteries = Battery::whereHas('owns', function($query) use ($company) {
                $query->where('companies_id', $company->id);
            })->get();

            $solarPanels = solar_panel::whereHas('owns', function($query) use ($company) {
                $query->where('companies_id', $company->id);
            })->get();

            $categories = Categories::whereHas('owns', function($query) use ($company) {
                $query->where('companies_id', $company->id);
            })->get();

            $companies = Company::all(); // جلب قائمة الشركات

            return view('company.View_All', compact('inverters', 'batteries', 'solarPanels', 'companies','categories'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to view this page.');
        }
    } else {
        return redirect()->back()->with('error', 'You are not authorized to view this page.');
    }
}


/***********************************************************Filter Product by Companies name**** */
public function getCompanyData($companyId)
{
    $company = Company::findOrFail($companyId);

    $inverters = Inverter::whereHas('companies', function($query) use ($company) {
        $query->where('companies_id', $company->id);
    })->with('companies')->get();

    $batteries = Battery::whereHas('companies', function($query) use ($company) {
        $query->where('companies_id', $company->id);
    })->with('companies')->get();

    $solarPanels = solar_panel::whereHas('companies', function($query) use ($company) {
        $query->where('companies_id', $company->id);
    })->with('companies')->get();

    $categories = Categories::whereHas('companies', function($query) use ($company) {
        $query->where('companies_id', $company->id);
    })->with('companies')->get();

    return response()->json([
        'inverters' => $inverters,
        'batteries' => $batteries,
        'solarPanels' => $solarPanels,
        'categories' => $categories,
    ]);
}

}
