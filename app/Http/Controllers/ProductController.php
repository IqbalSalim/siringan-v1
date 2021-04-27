<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = \App\Models\Product::paginate(10);
        $filterKeyword = $request->get('keywoard');
        if ($filterKeyword) {
            $products = \App\Models\Product::where('name', 'LIKE', "%$filterKeyword%")->paginate(10);
        }
        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get("name");
        $price = $request->get("price");
        $brand = $request->get("brand");
        $new_product = new \App\Models\Product();

        $new_product->name = $name;
        $new_product->price = $price;
        $new_product->brand = $brand;
        $new_product->created_by = \Auth::user()->id;
        $new_product->save();
        return redirect()->route('products.create')->with('status', 'Barang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product_to_edit = \App\Models\Product::findOrFail($id);
        return view('products.edit', ['product' => $product_to_edit]);
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
        $name = $request->get('name');
        $price = $request->get('price');
        $brand = $request->get('brand');

        $product = \App\Models\Product::findOrFail($id);
        $product->name = $name;
        $product->price = $price;
        $product->brand = $brand;
        $product->updated_by = \Auth::user()->id;
        $product->save();
        return redirect()->route('products.edit', [$id])->with('status', 'Barang berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('status', 'Barang dipindahkan ke tempat sampah');
    }

    public function trash()
    {
        $deleted_product = \App\Models\Product::onlyTrashed()->paginate(10);
        return view('products.trash', ['products' => $deleted_product]);
    }

    public function restore($id)
    {
        $product = \App\Models\Product::withTrashed()->findOrFail($id);
        if ($product->trashed()) {
            $product->restore();
        } else {
            return redirect()->route('products.index')->with('status', 'barang tidak di tempat sampah');
        }
        return redirect()->route('products.index')->with('status', 'Barang berhasil dikembalikan');
    }

    public function deletePermanent($id)
    {
        $product = \App\Models\Product::withTrashed()->findOrFail($id);
        if (!$product->trashed()) {
            return redirect()->route('products.index')->with('status', 'Tidak bisa menghapus barang aktiv');
        } else {
            $product->forceDelete();
            return redirect()->route('products.index')->with('status', 'barang berhasil dihapus');
        }
    }
}
