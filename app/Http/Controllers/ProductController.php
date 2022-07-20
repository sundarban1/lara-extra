<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        //  echo  request()->session()->get('user_id', '');
        $products = Products::all(); // select * from products';


        //   return response()->json(['products' => $products]);

        return view('product', ['products' => $products]);
    }

    public function update($id)
    {

        $product = Products::find($id);

        $product->name = 'Sundar Ban';

        $product->save();

        $products = Products::all(); // select * from products';


        return view('product', ['products' => $products]);
    }

    public function delete($id)
    {

        Products::destroy($id);

        $products = Products::all(); // select * from products';


        return view('product', ['products' => $products]);
    }
}
