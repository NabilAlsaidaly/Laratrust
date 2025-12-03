<?php

namespace App\Http\Controllers;

use App\Models\battery;
use App\Models\Categories;
use App\Models\company;
use App\Models\inverter;
use App\Models\solar_panel;
use App\Models\Technician;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $category = $request->input('category');
        $query = $request->input('query');

        $data1 = collect([]);
        $data2 = collect([]);
        $data3 = collect([]);
        $data4 = collect([]);
        $data5 = collect([]);
        $data6 = collect([]);

        if ($category == 'all' || $category == 'products') {
            $data1 = Inverter::where('name', 'LIKE', "%{$query}%")->get();
            $data2 = Battery::where('name', 'LIKE', "%{$query}%")->get();
            $data3 = solar_panel::where('name', 'LIKE', "%{$query}%")->get();
            $data6 = Categories::where('name', 'LIKE', "%{$query}%")->get();
        }

        if ($category == 'all' || $category == 'technicians') {
            $data4 = Technician::where('name', 'LIKE', "%{$query}%")->get();
        }

        if ($category == 'all' || $category == 'companies') {
            $data5 = Company::where('name', 'LIKE', "%{$query}%")->get();
        }

        return view('home.results', compact('data1', 'data2', 'data3', 'data4', 'data5','data6'));
    }
}
