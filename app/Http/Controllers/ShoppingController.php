<?php

namespace App\Http\Controllers;

use App\Models\battery;
use App\Models\bill;
use App\Models\buy;
use App\Models\Categories;
use App\Models\inverter;
use App\Models\Own;
use App\Models\solar_panel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ShoppingController extends Controller
{
    public function view()
    {
        return view('home.shopping');
    }
/****Solar******************************************************** */
public function cartsolar($id)
{
    $solar = solar_panel::findOrFail($id);
    $cart = session()->get('cart', []);

    if(isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            "solar_panel_id" => $id,
            "name" => $solar->name,
            "quantity" => 1,
            "price" => $solar->price,
            "image" => $solar->image
        ];
    }

    session()->put('cart', $cart);

    return redirect()->back()->with('success', 'Solar Panel has been added to cart!');
}

public function deletesolar($id)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    return redirect()->back()->with('success', 'Item has been removed from cart!');
}

// Inverter*/****************************************************** */
public function cartinverter($id)
{
    $inverter = inverter::findOrFail($id);
    $shoppingCart = session()->get('shoppingCart', []);

    if (isset($shoppingCart[$id])) {
        $shoppingCart[$id]['quantity']++;
    } else {
        $shoppingCart[$id] = [
            "name" => $inverter->name,
            "quantity" => 1,
            "price" => $inverter->price,
            "image" => $inverter->image,
            "inverter_id" => $inverter->id
        ];
    }

    session()->put('shoppingCart', $shoppingCart);

    return redirect()->back()->with('success', 'Inverter has been added to cart!');
}

public function deleteinverter($id)
{
    $shoppingCart = session()->get('shoppingCart', []);

    if (isset($shoppingCart[$id])) {
        unset($shoppingCart[$id]);
        session()->put('shoppingCart', $shoppingCart);
    }

    return redirect()->back()->with('success', 'Item has been removed from cart!');
}

// Battery*****************************************************/
public function cartbattery($id)
{
    $battery = Battery::findOrFail($id);
    $batteryCart = session()->get('batteryCart', []);

    if (isset($batteryCart[$id])) {
        $batteryCart[$id]['quantity']++;
    } else {
        $batteryCart[$id] = [
            "name" => $battery->name,
            "quantity" => 1,
            "price" => $battery->price,
            "image" => $battery->image,
            "battery_id" => $battery->id
        ];
    }

    session()->put('batteryCart', $batteryCart);

    return redirect()->back()->with('success', 'Battery has been added to cart!');
}

public function deletebattery($id)
{
    $batteryCart = session()->get('batteryCart', []);

    if (isset($batteryCart[$id])) {
        unset($batteryCart[$id]);
        session()->put('batteryCart', $batteryCart);
    }

    return redirect()->back()->with('success', 'Item has been removed from cart!');
}

// Category*****************************************************************/
public function cartcategory($id)
{
    $category = Categories::findOrFail($id);
    $categoryCart = session()->get('categoryCart', []);

    if (isset($categoryCart[$id])) {
        $categoryCart[$id]['quantity']++;
    } else {
        $categoryCart[$id] = [
            "name" => $category->name,
            "quantity" => 1,
            "price" => $category->price,
            "image" => $category->image,
            "categories_id" => $category->id
        ];
    }

    session()->put('categoryCart', $categoryCart);

    return redirect()->back()->with('success', 'Category has been added to cart!');
}

public function deletecategory($id)
{
    $categoryCart = session()->get('categoryCart', []);

    if (isset($categoryCart[$id])) {
        unset($categoryCart[$id]);
        session()->put('categoryCart', $categoryCart);
    }

    return redirect()->back()->with('success', 'Item has been removed from cart!');
}

// Confirm Purchase***********************************************************/
public function confirmPurchase(Request $request)
{
    $totalPrice = $request->input('total_price');

    if (Auth::check() && Auth::user()->usertype === 'user') {

        $cartItems = session('cart', []);
        $shoppingCartItems = session('shoppingCart', []);
        $batteryCartItems = session('batteryCart', []);
        $categoryCartItems = session('categoryCart', []);

        $allItems = array_merge($cartItems, $shoppingCartItems, $batteryCartItems, $categoryCartItems);

        try {
            // تحقق من توفر الكميات المطلوبة قبل إنشاء الفاتورة
            foreach ($allItems as $item) {
                if (!$this->isQuantityAvailable($item)) {
                    return redirect()->back()->with('error', 'Quantity requested for some items exceeds available stock.');
                }
            }

            $bill = Bill::create([
                'value' => $totalPrice,
                'date' => Carbon::now(),
            ]);

            Log::info('Bill created with ID:', ['bill_id' => $bill->id, 'value' => $totalPrice]);

            foreach ($allItems as $item) {
                $companyId = $this->getCompanyId($item);

                $buyData = [
                    'user_id' => Auth::id(),
                    'solar_panel_id' => $item['solar_panel_id'] ?? null,
                    'inverter_id' => $item['inverter_id'] ?? null,
                    'battery_id' => $item['battery_id'] ?? null,
                    'bill_id' => $bill->id,
                    'categories_id' => $item['categories_id'] ?? null,
                    'companies_id' => $companyId,
                    'quantities' => $item['quantity'],
                ];

                $buy = Buy::create($buyData);

                Log::info('Buy record created:', ['buy' => $buy]);

                // Decrement the stock quantity for the company
                $this->decrementStock($item);
            }

            session()->forget(['cart', 'shoppingCart', 'batteryCart', 'categoryCart']);

            return redirect()->route('home')->with('success', 'The Order Was Processed Successfully');

        } catch (\Exception $e) {
            Log::error('Error creating bill or buy records:', ['error' => $e->getMessage()]);

            return redirect()->route('home')->with('error', 'The request failed');
        }
    }

    return redirect()->route('login')->with('error', 'You Must Log In First');
}

// Helper function to check if the quantity is available
private function isQuantityAvailable($item)
{
    if (isset($item['solar_panel_id'])) {
        $solarPanel = solar_panel::find($item['solar_panel_id']);
        return $solarPanel && $solarPanel->quantities >= $item['quantity'];
    } elseif (isset($item['inverter_id'])) {
        $inverter = inverter::find($item['inverter_id']);
        return $inverter && $inverter->quantities >= $item['quantity'];
    } elseif (isset($item['battery_id'])) {
        $battery = Battery::find($item['battery_id']);
        return $battery && $battery->quantities >= $item['quantity'];
    } elseif (isset($item['categories_id'])) {
        $category = Categories::find($item['categories_id']);
        return $category && $category->quantities >= $item['quantity'];
    }

    return false;
}

// Helper function to get companies_id based on product type
private function getCompanyId($item)
{
    if (isset($item['solar_panel_id'])) {
        return Own::where('solar_panel_id', $item['solar_panel_id'])->first()->companies_id ?? 1;
    } elseif (isset($item['inverter_id'])) {
        return Own::where('inverter_id', $item['inverter_id'])->first()->companies_id ?? 1;
    } elseif (isset($item['battery_id'])) {
        return Own::where('battery_id', $item['battery_id'])->first()->companies_id ?? 1;
    } elseif (isset($item['categories_id'])) {
        return Own::where('categories_id', $item['categories_id'])->first()->companies_id ?? 1;
    }

    return 1;
}

// Helper function to decrement stock based on product type
private function decrementStock($item)
{
    if (isset($item['solar_panel_id'])) {
        $solarPanel = solar_panel::find($item['solar_panel_id']);
        if ($solarPanel) {
            $solarPanel->decrement('quantities', $item['quantity']);
        }
    } elseif (isset($item['inverter_id'])) {
        $inverter = inverter::find($item['inverter_id']);
        if ($inverter) {
            $inverter->decrement('quantities', $item['quantity']);
        }
    } elseif (isset($item['battery_id'])) {
        $battery = Battery::find($item['battery_id']);
        if ($battery) {
            $battery->decrement('quantities', $item['quantity']);
        }
    } elseif (isset($item['categories_id'])) {
        $category = Categories::find($item['categories_id']);
        if ($category) {
            $category->decrement('quantities', $item['quantity']);
        }
    }
}



/**Quantities***************************************************** */

    public function updateQuantity(Request $request, $id)
    {
        $quantity = $request->input('quantity');

        // Arrays for all carts
        $carts = [
            'cart',
            'shoppingCart',
            'batteryCart',
            'categoryCart'
        ];

        // Iterate over each cart session
        foreach ($carts as $cartName) {
            $cart = session($cartName, []);
            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
                session([$cartName => $cart]);
            }
        }

        return response()->json(['success' => true]);
    }



}








