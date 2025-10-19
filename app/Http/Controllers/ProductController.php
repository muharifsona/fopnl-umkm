<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\AuditHelper;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->latest()->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'net_weight' => 'nullable|numeric',
            'serving_size' => 'nullable|string|max:100',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'draft';

        $product = Product::create($validated);

        // 🔹 Catat ke Audit Log
        AuditHelper::log(
            'products',               // entity
            $product->id,             // entity_id
            'store',                 // action
            'Menambahkan produk baru: ' . $product->name // details
        );

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'net_weight' => 'nullable|numeric',
            'serving_size' => 'nullable|string|max:100',
        ]);

        $product->update($validated);

        // 🔹 Catat ke Audit Log
        AuditHelper::log(
            'products',               // entity
            $product->id,             // entity_id
            'update',                 // action
            'Mengedit produk: ' . $product->name // details
        );

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();

        // 🔹 Catat ke Audit Log
        AuditHelper::log(
            'products',               // entity
            $product->id,             // entity_id
            'destroy',                 // action
            'Menghapus produk: ' . $product->name // details
        );

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
