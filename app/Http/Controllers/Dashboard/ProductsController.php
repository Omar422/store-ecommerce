<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Tag;
use App\Models\Image;
use App\Http\Requests\GeneralProductRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Http\Requests\ProductStockRequest;
use App\Http\Requests\ProductImagesRequest;
use DB;

class ProductsController extends Controller
{
    public function index() {
        $products = Product::select('id','slug', 'price','created_at')->paginate(PAGINATION_COUNT);
        return view('dashboard.products.general.index', compact('products'));
    }

    public function create() {
        $data = [];
        $data['brands'] = Brand::active() -> select('id') -> get();
        $data['tags'] = Tag::select('id') -> get();
        $data['categories'] = Category::active() -> select('id') -> get();
        return view('dashboard.products.general.create', $data);
    }

    public function store(ProductPriceValidation $request) {
        // return $request;

        try {

            DB::beginTransaction();

            if($request->has('is_active')) {
                $request-> request->add(['is_active' => 1]);
            } else {
                $request-> request->add(['is_active' => 0]);
            }

            // save the main data
            $product = Product::create([
                'slug'          => $request->slug,
                'brand_id'      => $request->brand_id,
                'is_active'     => $request->is_active,
            ]);

            // save the translations data
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->save();

            // save categories -many to many tables-
            $product->categories() -> attach($request->categories);

            DB::commit();
            return redirect() -> route('admin.products') -> with(['success' => 'تمت الإضافة بنجاح']);

        } catch (\Exception $ex) {
            DB::rollback();
            return redirect() -> route('admin.categories') -> with(['error' => 'هناك خطأ ما']);
        }
    }

    public function getPrice($product_id) {
        return view('dashboard.products.price.create')->with('id', $product_id);
    }

    public function saveProductPrice(ProductPriceValidation $request) {
        // return $request;

        try {

            Product::whereId($request->product_id)->update($request->only(['price', 'special_price', 'special_price_type', 'special_price_start', 'special_price_end',]));
            return redirect() -> route('admin.products') -> with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {

        }
    }

    public function getStock($product_id) {
        $product = Product::find($product_id);
        if(!$product)
            return redirect() -> route('admin.products') -> with(['error' => 'المنتج غير موجود']);

        return view('dashboard.products.stock.create', compact('product'));
    }

    public function saveProductStock(ProductStockRequest $request) {

        try {

            Product::whereId($request->product_id)->update($request->except(['_token', 'product_id']));
            return redirect() -> route('admin.products') -> with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
        }
    }

    public function addimages($product_id){

        // $product_images = Image::select('photo')->where('product_id', $product_id);
        $product_images = Image::all()->where('product_id', $product_id);

        // return view('dashboard.products.images.create')->withId($product_id);
        return view('dashboard.products.images.create', compact(['product_images', 'product_id']));

    }

    // save to folder
    public function uploadProductimages(Request $request){

        $file = $request->file('product_images');
        $filename = uploadImage('products', $file);

        return response()->json([
            'name'  => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    // save to db
    public function saveProductimages(ProductImagesRequest $request){
        try {

            if($request->has('document') && count($request->document) > 0) {
                foreach($request->document as $image) {
                    Image::create([
                        'product_id' => $request->product_id,
                        'photo' => $image,
                    ]);
                }
                return redirect() -> route('admin.products') -> with(['success' => 'تم التحديث بنجاح']);
            }

        } catch (\Execption $ex) {

            return redirect() -> route('admin.products') -> with(['error' => 'هناك خطأ ما']);

        }
    }

    public function deleteimage($id) {
        try {

            $image = Image::find($id);
            if(!$image)
            return redirect() -> back();

            $image -> delete();
            return redirect() -> back() -> with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            return redirect() -> back() -> with(['error' => 'هناك خطأ ما']);
        }
    }


}
