<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\company;
use App\Models\Own;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function Add_Categories()
    {

        $userId = auth()->id();

        $company = company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active)

        {
        return view('company.Add_Categories');
        }
    else
    {
        return redirect()->back();
    }
}
/***************************************************************************** */

    public function create_categories(Request $request)
    {

        $userId = auth()->id();

        $company = company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active)

        {

        $data = new Categories;

        $data->name = $request->title;

        $data->price = $request->price;

        $data->quantities = $request->quantities;

        $data->description	 = $request->description;

        $image=$request->image;

        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('Categories',$imagename);

            $data->image=$imagename;
        }

        $data->save();

        $own = new Own;
        $own->companies_id = $company->id;
        $own->categories_id = $data->id;
        $own->save();

        return redirect()->back();
    }
    }
    /**************************************************************************** */

    public function View_Categories()
{
    $userId = auth()->id();
    $user = auth()->user();

    if ($user->usertype == 'admin') {

        $data = Categories::all();
        return view('admin.View_Categories', compact('data'));
    } elseif ($user->usertype == 'company') {

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {
            $data = Categories::whereHas('owns', function($query) use ($company) {
                $query->where('companies_id', $company->id);
            })->with('companies')->get();

            return view('company.View_Categories', compact('data'));
        } else {
            return redirect()->back()->with('error', 'You are not authorized to view this page.');
        }
    } else {
        return redirect()->back()->with('error', 'You are not authorized to view this page.');
    }
}

/********************************************************************************* */
public function Delete_Categories($id)
{
    $data=Categories::find($id);

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

public function Update_Categories($id)
    {
        $data=Categories::find($id);
        return view('company.Update_Categories',compact('data'));
    }

/******************************************************************************* */

    public function edit_categories(Request $request , $id)
    {
        $data=Categories::find($id);

        if ($data)
        {
        $userId = auth()->id();

        $company = Company::where('user_id', $userId)->first();

        if ($company && $company->user->is_active) {

        $data->name = $request->title;

        $data->price = $request->price;

        $data->quantities = $request->quantities;

        $data->description	 = $request->description;

        $image=$request->image;

        if($image)
        {
            $imagename=time().'.'.$image->getClientOriginalExtension();

            $request->image->move('Categories',$imagename);

            $data->image=$imagename;
        }

        $data->save();

        return redirect()->back();
    }
    }
    }

    public function showCategoriesPage()
    {
        $data = Categories::all();

        return view('home.Categories', compact('data'));
    }


    public function showCategoryDetails($id)
    {
        $category = Categories::find($id);

        if ($category) {
            return view('home.category_details', compact('category'));
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }
}
