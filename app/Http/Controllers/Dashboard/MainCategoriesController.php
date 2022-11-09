<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;
use App\Http\Enumerations\CategoryType;

class MainCategoriesController extends Controller
{
    public function index() {
        $categories = Category::with('category_parent')->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create() {
        $categories = Category::select('id', 'parent_id')->get();
        return view('dashboard.categories.create', compact('categories'));
    }

    public function store(MainCategoryRequest $request) {
        // return $request;
        try {

            DB::beginTransaction();

            if(!$request -> has('is_active'))
                $request -> request -> add(['is_active' => 0]);
            else
                $request -> request -> add(['is_active' => 1]);

            if($request->type == CategoryType::mainCategory) { // maincat or subcat .. if 1 => main
                $request -> request -> add(['parent_id' => null]);
            }

            $category = Category::create($request->except('_token'));
            $category -> name = $request -> name;
            $category -> save();

            DB::commit();
            return redirect() -> route('admin.maincategories') -> with(['success' => 'تمت الإضافة بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.maincategories') -> with(['error' => 'هناك خطأ ما']);
        }
    }

    public function edit($id) {
        $category = Category::find($id);

        if(!$category)
            return redirect() -> route('admin.maincategories') -> with(['error' => 'القسم غير موجود']);

        return view('dashboard.categories.edit', compact('category'));

    }

    public function update($id, MainCategoryRequest $request) {
        // return $request;
        // validation
        try {

            $category = Category::find($id);

            if(!$category)
                return redirect() -> route('admin.maincategories') -> with(['error' => 'هذا القسم غير موجود']);

            if(!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $category->update($request->all());
            $category -> name = $request -> name;
            $category -> save();

            return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);


        } catch (\Exception $ex) {
            return redirect() -> route('admin.maincategories') -> with(['error' => 'هناك خطأ ما']);
        }

    }

    public function destroy($id) {

        try {

            $category = Category::find($id);
            if(!$category)
                return redirect() -> route('admin.maincategories') -> with(['error' => 'هذا القسم غير موجود']);

            $category -> delete();
            return redirect() -> route('admin.maincategories') -> with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect() -> route('admin.maincategories') -> with(['error' => 'هناك خطأ ما']);
        }

    }

    public function changeStatus(MainCategoryRequest $request) {}
}
