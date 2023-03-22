<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {
        $this->middleware('auth')->except(['show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('product.index', [
            'products' => $this->productService->getList($request->input()) ?? []
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('product.show', [
            'product' => $this->productService->getById(decrypt($id))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('product.form', [
            'product' => $this->productService->getById(decrypt($id)),
            'formRoute' => route('product.update', $id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $product)
    {
        $input = $request->validated();
        $this->productService->updateById(decrypt($product), $input, $request->file('image'));
        return back()->with('flash_message', [
            'status' => 'success',
            'message' => 'Product updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function removeImage(string $product)
    {
        $this->productService->removeImage(decrypt($product));

        return back()->with('flash_message', [
            'status' => 'success',
            'message' => 'Image removed successfully'
        ]);
    }
}
