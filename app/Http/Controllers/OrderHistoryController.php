<?php

namespace App\Http\Controllers;

use App\Models\bill;
use App\Models\company;
use App\Models\User;
use App\Models\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
/*************************Show_Bill For User**********************************888 */
    public function index()
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $bills = Bill::whereHas('buy', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->with(['buy' => function($query) use ($userId) {
                $query->where('user_id', $userId);
            }, 'buy.solarPanel', 'buy.inverter', 'buy.battery', 'buy.categories', 'buy.company'])->get();

            return view('home.bill', compact('bills'));
        }

        return redirect()->route('login')->with('error', 'You Must Log In First');
    }

/**View_Bills For Comapny************************************************************** */
    public function View_Bills()
    {
        $userId = auth()->id();
        $company = Company::where('user_id', $userId)->first();
        if ($company && $company->user->is_active) {
            $usersWithOrders = User::whereHas('buy', function ($query) use ($company) {
                    $query->where('companies_id', $company->id);
                })
                ->with(['buy' => function ($query) use ($company) {
                    $query->where('companies_id', $company->id)
                    ->with(['solarPanel', 'inverter', 'battery', 'categories']);
                }])
                ->get();
            return view('company.View_Bills', compact('usersWithOrders'));
        } else {
            return redirect()->back();
        }
    }

}
