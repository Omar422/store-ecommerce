<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    //
    public function editShippingMethods($type) {
        // three types: free, local, outer
        if($type === 'free') {

            $shipping_method = Setting::where('key', 'free_shipping_label')->first();

        } else if ($type === 'local') {

            $shipping_method = Setting::where('key', 'local_shipping_label')->first();

        } else if ($type === 'outer') {

            $shipping_method = Setting::where('key', 'outer_shipping_label')->first();

        } else {

            $shipping_method = Setting::where('key', 'free_shipping_label')->first();
        }

        return view('dashboard.settings.shippings.edit', compact('shipping_method'));
    }

    public function updateShippingMethods(Request $request, $id) {

    }
}
