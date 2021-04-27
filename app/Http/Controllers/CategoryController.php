<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = \App\Models\Category::paginate(10);
        // var_dump('<pre>', $categories, '</pre>');
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_category = new \App\Models\Category();
        $new_category->name = $request->get('name');
        $new_category->info = $request->get('info');
        $new_category->created_by = \Auth::user()->id;
        $new_category->save();
        return redirect()->route('categories.create')->with('status', 'Data kategori berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category_to_edit = \App\Models\Category::findOrFail($id);
        return view('categories.edit', ['category' => $category_to_edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $info = $request->get('info');
        $category = \App\Models\Category::findOrFail($id);
        $category->info = $info;
        $category->updated_by = \Auth::user()->id;
        $category->save();
        return redirect()->route('categories.edit', [$id])->with('status', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->forceDelete();
        return redirect()->route('categories.index')->with('status', 'Kategori berhasil dihapus');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        $categories = \App\Models\Category::where("info", "LIKE", "%$keyword%")->get();
        return $categories;
    }
}
