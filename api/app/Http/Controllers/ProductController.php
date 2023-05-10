<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    protected $products;

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(Request $request) {
        
        $products = $this->products
                            ->where('title', 'like', '%'. $request->search . '%')
                            ->orderBy('title', 'asc');

        return $products->paginate(1);

    }

    public function store(Request $request) {
        $newProduct = $this->products->create([
            'title' => $request->title,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'ingredients' => $request->ingredients,
            'sku' => $request->sku
        ]);

        return response()->json([
            'data' => $newProduct,
            'message' => 'Product successfully added'
        ], 200);
    }

    public function update(Request $request, $id) {


        $product = $this->products->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product id#' . $id . ' not found'
            ], 500);
        }

        $product->title = $request->title;
        $product->quantity = $request->quantity;
        $product->ingredients = $request->ingredients;

        $product->save();

        return  response()->json([
            'data' => $product,
            'message' => 'Product successfully updated.'
        ], 200);
    } 

    public function destroy($id) {
        $product = $this->products->find($id);

        if (!$product) {
            return response()->json([
                'message' => 'Product id#' . $id . ' not found'
            ], 500);
        }

        $product->delete();

        return  response()->json([
            'message' => 'Product successfully deleted.'
        ], 200);

    }




}
