<?php

namespace App\Http\Controllers;

use App\Interfaces\Categories\CategoryServiceInterface;
use Illuminate\Http\Request;

class CCCController extends Controller
{
    private $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(Request $request)
    {
        $data = $request->all();
        dd($data);

    }
}
