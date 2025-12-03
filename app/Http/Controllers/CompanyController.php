<?php

namespace App\Http\Controllers;

use App\Models\company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function View_Companies()
    {
        $data = company::all();

        return view('admin.View_Companies',compact('data'));
    }

    public function showcompanyPage()
    {
        $data = company::all();

        return view('home.company', compact('data'));
    }
}
