<?php

namespace App\Http\Controllers;

use DataTables;
use App\Product;
use App\Category;
use App\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productmodel;

    public function __construct(Product $productmodel)
    {
        $this->productmodel = $productmodel;
    }
    
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('product.index');
    }

    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $datatables = app(\Yajra\Datatables\Datatables::class);
        $collection = Product::withTrashed()->with(['category']);
        $collection = $datatables->of($collection);
        $collection->addColumn('category_name', function ($product){
            $result = '';
            if(isset($product->category) && count($product->category)){
                // $result = $product->category->name;
                return view('product.categories',compact('product'));
            }
            return $result;
        });
        $collection->addColumn('action', function ($product) {
            return view('product.tableAction',compact('product'));
        });
        $collection->rawColumns(['id']);
        return $collection->setRowId('id')->make(true);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        list($products) = $this->commonDropdown('create');
        $product_code = Str::getNextAutoNumber('Product','PROD');
        $all_categoies = Category::getDropDown()->toArray();
        if (($key = array_search("Select", $all_categoies)) !== false) {
            unset($all_categoies[$key]);
        }
        return view('product.create', compact('products','product_code','all_categoies'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Note: we can do it by model but did not get chance
        $this->validate($request, [
            'name' => 'required|max:50'
        ]);
        DB::beginTransaction();
        try{
            $product_category_ids = $request->product_category_ids;

            $product = new Product();
            $product->name = $request->name;
            $product->product_code = Str::getNextAutoNumber('Product','PROD');
            if($request->hasFile('image')){
                $file = $request->file('image');
                $fileName = time().'.'.$file->extension(); 
                $file->move(public_path('uploads'), $fileName);
                $product->image = $fileName;
            }
            $product->save();

            if(sizeof($product_category_ids)>0){
                foreach($product_category_ids as $category_id){
                    $product_category = new ProductCategory();
                    $product_category->create(['category_id' => $category_id, 'product_id' => $product->id]);
                }
            }

            Session::flash('status',"$request->name has been created");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('warning',"something went wrong while creating product");
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $product_code = $product->product_code;
        $product_categoies = $product->category->pluck('id');
        $all_categoies = Category::getDropDown()->toArray();
        if (($key = array_search("Select", $all_categoies)) !== false) {
            unset($all_categoies[$key]);
        }
        return view('product.edit', compact('product','product_code','all_categoies','product_categoies'));
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Note: we can do it by model but did not get chance
        $this->validate($request, [
            'name' => 'required|max:50',
            'image' => 'mimes:jpeg,jpg,gif,png'
        ]);
        DB::beginTransaction();
        try{
            $product_category_ids = $request->product_category_ids;
            $product = Product::findOrFail($id);
            $product->name = $request->name;
            if($request->hasFile('image')){
                $previous_image = $product->image;
                $filePath = public_path('uploads')."/".$previous_image;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $file = $request->file('image');
                $fileName = time().'.'.$file->extension(); 
                $file->move(public_path('uploads'), $fileName);
                $product->image = $fileName;
            }
            $product->update();

            //Here we can directy delete old and create new category but if we want to use aleady created relation id we can apply below logic

            // //Delete previous categories
            //     $remove_previous_caregories = ProductCategory::where('product_id',$id)->delete();
            // //Add new categories
            // if(sizeof($product_category_ids)>0){
            //     foreach($product_category_ids as $category_id){
            //         $product_category = new ProductCategory();
            //         $product_category->create(['category_id' => $category_id, 'product_id' => $id]);
            //     }
            // }

            //Logic start
            $previous_caregories_data = ProductCategory::where('product_id',$id)->get();
        
            $previous_caregories_ids = [];
            if(sizeof($previous_caregories_data)>0){
                foreach($previous_caregories_data as $previous_mapper_data){
                    array_push($previous_caregories_ids,$previous_mapper_data->category_id);
                }
            }
            $current_category_ids = [];
            if(sizeof($product_category_ids)){
                foreach($product_category_ids as $category_id){
                    array_push($current_category_ids,$category_id);
                }
            }
            $same_ids_obj = array_intersect($previous_caregories_ids, $current_category_ids);
            $same_department_ids_array = [];
            if(sizeof($same_ids_obj)>0){
                foreach($same_ids_obj as $same_ids){
                    array_push($same_department_ids_array,$same_ids);
                }
            }
            
            //Delete Previous category data
            $delete_previous_department_data = ProductCategory::where('product_id',$id)->whereNotIn('category_id',$same_department_ids_array)->delete();

            //Create New department mapping
            if(count($product_category_ids)){
                foreach($product_category_ids as $category_id){
                    $category_mapping_data = ProductCategory::where('product_id',$id)->where('category_id',$category_id)->count();
                    if($category_mapping_data == 0){
                        $mapper_data = new ProductCategory();
                        $mapper_data->product_id = $id;
                        $mapper_data->category_id = $category_id;
                        $mapper_data->save();
                    }
                }
            }
            Session::flash('status',"$request->name has been updated");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('warning',"something went wrong while editing product");
        }
        return redirect()->route('product.index');

    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $product = Product::findOrFail($id);
            $name = $product->name;
            $product->delete();
            
            ProductCategory::where('product_id',$id)->delete();

            Session::flash('status',"$name has been deleted");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('warning',"something went wrong while deleting product");
        }
        return redirect()->route('product.index');
    }
    /**
     * Restore the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $product = Product::withTrashed()->where('id', $id)->restore();
        Session::flash('status',"Product has been restored");
        return redirect()->route('product.index');
    }

    /**
     * Returns  product lists in this order
     * Decouple it with list().
     *
     * @return array
     */
    protected function commonDropdown($action)
    {
        $products = Product::all();
        return [$products->pluck('name', 'id')->prepend('Select','')];
    }
}
