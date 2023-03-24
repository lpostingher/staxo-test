<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct(
        private readonly ProductService $productService
    ) {
    }

    /**
     * Handle index requests
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('home.index', [
            'products' => $this->productService->getList($request->input()),
            'searchData' => $request->input()
        ]);
    }
}
