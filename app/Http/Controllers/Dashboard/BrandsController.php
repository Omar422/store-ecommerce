<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use DB;

class BrandsController extends Controller
{

    public function index() {
        $brands = Brand::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.brands.index', compact('brands'));
    }

    public function create() {
        return view('dashboard.brands.create');
    }

    public function store(BrandRequest $request) {
        // return $request;
        try {

            DB::beginTransaction();

            if(!$request -> has('is_active'))
                $request -> request -> add(['is_active' => 0]);
            else
                $request -> request -> add(['is_active' => 1]);

            $file_name = '';
            if($request -> has('photo')) {
                $file_name = uploadImage('brands', $request->photo);
            }

            $brand = Brand::create($request->except('_token', 'photo'));
            $brand -> name = $request -> name; // save translation
            $brand -> photo = $file_name;
            $brand -> save();

            DB::commit();
            return redirect() -> route('admin.brands') -> with(['success' => 'تمت الإضافة بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.brands') -> with(['error' => 'هناك خطأ ما']);
        }
    }

    public function edit($id) {
        $brand = Brand::find($id);

        if(!$brand)
            return redirect() -> route('admin.brands') -> with(['error' => 'العلامة التجارية غير موجودة']);

        return view('dashboard.brands.edit', compact('brand'));

    }

    public function update($id, BrandRequest $request) {
        // return $request;
        // validation
        try {

            $brand = Brand::find($id);

            if(!$brand)
                return redirect() -> route('admin.brands') -> with(['error' => 'هذه العلامة التجارية غير موجودة']);

            DB::beginTransaction();

            // save the image the name
            if($request -> has('photo')) {
                $file_name = uploadImage('brands', $request->photo);
                Brand::where('id', $id)->update([
                    'photo'     => $file_name,
                ]);
            }

            if(!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $brand->update($request->except('_token', 'id', 'photo'));
            $brand -> name = $request -> name;
            $brand -> save();

            DB::commit();
            return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.brands') -> with(['error' => 'هناك خطأ ما']);
        }

    }

    public function destroy($id) {

        try {

            $brand = Brand::find($id);
            if(!$brand)
            return redirect() -> route('admin.brands') -> with(['error' => 'هذه العلامة التجارية غير موجودة']);

            $brand -> delete();
            return redirect() -> route('admin.brands') -> with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect() -> route('admin.brands') -> with(['error' => 'هناك خطأ ما']);
        }

    }

    public function changeStatus(BrandRequest $request) {}
}
