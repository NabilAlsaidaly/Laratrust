<?php

namespace App\Http\Controllers;

use App\Models\battery;
use App\Models\Categories;
use App\Models\company;
use App\Models\inverter;
use App\Models\solar_panel;
use App\Models\Technician;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function showProduct()
    {
        $data1 = Inverter::all();
        $data2 = Battery::all();
        $data3 = solar_panel::all();
        $data4 = Technician::all();
        $data5 = Categories::all();
        $data6 = company::all();

        return view('home.welcome', compact('data1', 'data2', 'data3','data4','data5','data6'));
    }
/************************************************************** */
    public function AllProduct()
    {
        $data1 = Inverter::all();
        $data2 = Battery::all();
        $data3 = solar_panel::all();
        $data5 = Categories::all();

        return view('home.Product', compact('data1', 'data2', 'data3','data5'));
    }

/*************************************************************** */

public function showCompanyProducts($companyId)
{
    $company = Company::with(['batteries', 'inverter', 'solar', 'categories'])
                ->findOrFail($companyId);
    return view('home.Details', [
        'inverters' => $company->inverter,
        'batteries' => $company->batteries,
        'solar' => $company->solar,
        'categories' => $company->categories,
        'company' => $company,
    ]);
}

}


