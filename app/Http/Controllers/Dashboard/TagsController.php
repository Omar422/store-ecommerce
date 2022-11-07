<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\TagRequest;
use Illuminate\Http\Request;
use DB;

class TagsController extends Controller
{

    public function index() {
        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index', compact('tags'));
    }

    public function create() {
        return view('dashboard.tags.create');
    }

    public function store(TagRequest $request) {
        // return $request;
        try {

            DB::beginTransaction();

            // $tag = Tag::create($request->only('slug'));
            $tag = Tag::create(['slug' => $request->slug]);
            $tag -> name = $request -> name; // save translation

            $tag -> save();

            DB::commit();
            return redirect() -> route('admin.tags') -> with(['success' => 'تمت الإضافة بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.tags') -> with(['error' => 'هناك خطأ ما']);
        }
    }

    public function edit($id) {
        $tag = Tag::find($id);

        if(!$tag)
            return redirect() -> route('admin.tags') -> with(['error' => 'العلامة التجارية غير موجودة']);

        return view('dashboard.tags.edit', compact('tag'));

    }

    public function update($id, TagRequest $request) {
        // return $request;
        // validation
        try {

            $tag = Tag::find($id);

            if(!$tag)
                return redirect() -> route('admin.tags') -> with(['error' => 'هذه العلامة التجارية غير موجودة']);

            DB::beginTransaction();

            $tag->update($request->except('_token', 'id'));
            $tag -> name = $request -> name;
            $tag -> save();

            DB::commit();
            return redirect() -> back() -> with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.tags') -> with(['error' => 'هناك خطأ ما']);
        }

    }

    public function destroy($id) {

        try {

            $tag = Tag::find($id);
            if(!$tag)
            return redirect() -> route('admin.tags') -> with(['error' => 'هذه العلامة التجارية غير موجودة']);

            $tag -> delete();
            return redirect() -> route('admin.tags') -> with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect() -> route('admin.tags') -> with(['error' => 'هناك خطأ ما']);
        }

    }

    public function changeStatus(TagRequest $request) {}
}
