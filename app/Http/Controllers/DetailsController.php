<?php

namespace App\Http\Controllers;

use App\Models\battery;
use App\Models\company;
use App\Models\inverter;
use App\Models\solar_panel;
use App\Models\Technician;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    public function show($type, $id)
    {
        switch($type) {
            case 'inverter':
                $item = inverter::findOrFail($id);
                break;
            case 'battery':
                $item = battery::findOrFail($id);
                break;
            case 'solar':
                $item = solar_panel::findOrFail($id);
                break;
            case 'technician':
                $item = Technician::findOrFail($id);
                break;
            case 'company':
                $item = company::findOrFail($id);
                break;
            default:
                abort(404);
        }

        return view('home.details', ['item' => $item, 'type' => $type]);
    }
}
