<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Http\Requests\ShippingsRequest;
use Illuminate\Http\Request;
use DB;

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

    public function updateShippingMethods(ShippingsRequest $request, $id) {
        // return $request;

        // validation in ShippingRequest request

        try {
            // update
            $shipping_method = Setting::find($id);

            // transaction => apply all or nothing
            // DB::transaction(function(){//code});
            DB::beginTransaction();

            $shipping_method -> update([
                'plain_value'               => $request -> plain_value,
            ]);
            $shipping_method -> value = $request -> value;
            $shipping_method -> save();

            DB::commit();

            return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            return $ex;
            return redirect() -> back() -> with(['error' => 'هناك خطأ ما، حاول مرة أخرى']);
            DB::rollback();
        }
    }
}
