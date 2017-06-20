<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /*
     * Query products
     *
     * @return object
     * */
    public function get ()
    {
        return Product::where('work_group_id', Session::get('work_group')->id)->get();
    }

    /*
     * Show list products
     *
     * @return view
     * */
    public function show ()
    {

        $Products = $this->get();

        return view('products.show', compact('Products'))->render();
    }
}
