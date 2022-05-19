<?php

namespace App\Http\Controllers;

use DataTables;
use App\Category;
use App\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{

    protected $categories;

    public function __construct(Category $categories)
    {
        $this->categories = $categories;
    }

    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index');
    }

    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function datatable(Request $request)
    {
        $datatables = app(\Yajra\Datatables\Datatables::class);
        $collection = Category::withTrashed()->with(['parentcat']);
        $collection = $datatables->of($collection);
        $collection->addColumn('parent_category_name', function ($category){
            $result = '';
            if(isset($category->parent_category_id) && !empty($category->parent_category_id)){
                $result = $category->parentcat->name;
            }
            return $result;
        });
        $collection->addColumn('action', function ($category) {
            return view('category.tableAction',compact('category'));
        });
        $collection->rawColumns(['id']);
        return $collection->setRowId('id')->make(true);
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::getDropDown();
        $category_code = Str::getNextAutoNumber('Category','CAT');
        return view('category.create', compact('categories','category_code'));
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Note we can do it by model but did not get chance
        $this->validate($request, [
            'name' => 'required|max:50'
        ]);
        DB::beginTransaction();
        try{
            $category = new Category();
            $category->create(['name' => $request->name, 'category_code' => Str::getNextAutoNumber('Category','CAT'), 'parent_category_id' => $request->parent_category_id]);
            Session::flash('status',"$request->name has been created");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('warning',"something went wrong while creating category");
        }
        return redirect()->route('category.index');
    }

    /**
     * Display the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $categories = Category::getDropDown();
        $category_code = $category->category_code;

        return view('category.edit', compact('category','categories','category_code'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Note we can do it by model but did not get chance
        $this->validate($request, [
            'name' => 'required|max:50'
        ]);
        $category = Category::findOrFail($id);
        $category->update(['name' => $request->name, 'parent_category_id' => $request->parent_category_id]);
        Session::flash('status',"$request->name has been updated");
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $category = Category::findOrFail($id);
            $name = $category->name;
            $category->delete();

            //Delete referance with related product  
            Category::where('parent_category_id',$id)->update(['parent_category_id'=>NULL]);

            //Delete referance with related product if you want
            // ProductCategory::where('category_id',$id)->delete();

            Session::flash('status',"$name has been deleted");
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('warning',"something went wrong while deleting category");
        }
        return redirect()->route('category.index');
    }
    /**
     * Restore the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(Request $request, $id)
    {
        $category = Category::withTrashed()->where('id', $id)->restore();
        Session::flash('status',"Category has been restored");
        return redirect()->route('category.index');
    }
    
}
