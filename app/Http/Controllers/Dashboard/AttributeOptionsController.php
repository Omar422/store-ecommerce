<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OptionRequest;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\Option;
use DB;

class AttributeOptionsController extends Controller
{

    public function index() {
        $options = Option::with(['product' => function($p) {
            $p -> select('id');
        }, 'attribute' => function($a) {
            $a -> select('id');
        }])->select('id', 'product_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);;
        return view('dashboard.options.index', compact('options'));
    }

    public function create() {
        $data = [];
        $data['products'] = Product::active() -> select('id') -> get();
        $data['attributes'] = Attribute::select('id') -> get();
        return view('dashboard.options.create', $data);
    }

    public function store(OptionRequest $request) {

        DB::beginTransaction();

        $option = Option::create([
            'product_id'        => $request->product_id,
            'attribute_id'      => $request->attribute_id,
            'price'             => $request->price
        ]);

        # save translation
        $option->name = $request->name;
        $option->save();

        DB::commit();
        return redirect()->route('admin.attribute.options')->with(['success' => 'تمت الإضافة بنجاح']);
    }

}
