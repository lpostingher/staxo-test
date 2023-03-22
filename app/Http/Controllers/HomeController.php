<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    )
    {
    }

    public function index(Request $request)
    {
        return view('home.index', [
            'products' => $this->productService->getList($request->input()),
            'searchData' => $request->input()
        ]);
    }
}
