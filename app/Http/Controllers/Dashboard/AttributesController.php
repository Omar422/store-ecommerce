<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Http\Requests\AttributeRequest;
use DB;

class AttributesController extends Controller
{

    public function index() {
        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index', compact('attributes'));
    }

    public function create() {
        return view('dashboard.attributes.create');
    }

    public function store(AttributeRequest $request) {
        // return $request;
        try {

            DB::beginTransaction();

            $attribute = Attribute::create();
            $attribute -> name = $request -> name; // save translation
            $attribute -> save();

            DB::commit();
            return redirect() -> route('admin.attributes') -> with(['success' => 'تمت الإضافة بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.attributes') -> with(['error' => 'هناك خطأ ما']);
        }
    }

    public function edit($id) {
        $attribute = Attribute::find($id);

        if(!$attribute)
            return redirect() -> route('admin.attributes') -> with(['error' => 'هذه الخاصية غير موجودة']);

        return view('dashboard.attributes.edit', compact('attribute'));

    }

    public function update($id, AttributeRequest $request) {
        // return $request;
        // validation
        try {

            $attribute = Attribute::find($id);

            if(!$attribute)
                return redirect() -> route('admin.attributes') -> with(['error' => 'هذه الخاصية غير موجودة']);

            DB::beginTransaction();

            $attribute -> name = $request -> name;
            $attribute -> save();

            DB::commit();
            return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.attributes') -> with(['error' => 'هناك خطأ ما']);
        }

    }

    public function destroy($id) {

        try {

            $attribute = Attribute::find($id);
            if(!$attribute)
            return redirect() -> route('admin.attributes') -> with(['error' => 'هذه الخاصية غير موجودة']);

            $attribute -> delete();
            return redirect() -> route('admin.attributes') -> with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect() -> route('admin.attributes') -> with(['error' => 'هناك خطأ ما']);
        }

    }
}
