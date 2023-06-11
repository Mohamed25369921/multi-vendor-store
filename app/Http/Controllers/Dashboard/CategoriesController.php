<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
{
    public $categories;
    public function __construct() {
        $this->categories = Category::all();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.categories.index',['categories' => $this->categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create',['categories' => $this->categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'slug' => Str::slug($request->post('name'))
        ]);
        Category::create($request->all());
        return redirect()->route('dashboard.categories.index')->with('success','Category Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id','<>',$id )
        ->where(function($q) use ($id){
            $q->whereNull('parent_id')
            ->orWhere('parent_id', '<>',$id);
        })->get();
        return view('dashboard.categories.edit',['category' => $category, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('dashboard.categories.index')->with('success','Category Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Category::destroy($id);
        return redirect()->route('dashboard.categories.index')->with('success','Category Deleted Successfully!');
    }
}
