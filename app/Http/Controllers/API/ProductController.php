<?php

namespace App\Http\Controllers\API;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends BaseController
{
    public function addProduct(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'price' => 'required',
                'filePath' => 'required',
            ]
        );
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $products = new Products;
        $products->name = $request->name;
        $products->price = $request->price;
        $products->filePath = $request->file('filePath')->store('products');
        $products->description = $request->description;
        $products->save();
        return $this->sendResponse($products, 'products Added successfully.');
    }

    public function editProduct(Request $request,$id)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'price' => 'required',
                'filePath' => 'required',
            ]
        );
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 400);
        }

        $products = Products::find($id);
        $products->name = $request->name;
        $products->price = $request->price;
        $products->filePath = $request->file('filePath')->store('products');
        $products->description = $request->description;
        $products->save();
        return $this->sendResponse($products, 'products Added successfully.');
    }


    public function deleteProduct($id)
    {
        $products = Products::find($id);
        if (is_null($products)) {
            return $this->sendError('Not Found Deleted Unsuccessfully.' );
        } else {
            $products->delete();
            return $this->sendSuccess('deleted successfully.');
        }
    }

    public function getProductById($id)
    {
        $products = Products::find($id);
        if (is_null($products))
            return $this->sendError('products Not Found ');
        return $this->sendResponse($products, 'We Found it.');
    }

    public function getProductByName($name)
    {
        $products = Products::where('name', 'Like',"%$name%")->get();

        return $this->sendResponse($products, 'products retrieved successfully.');
    }

    public function getAllProduct()
    {
        $products = Products::all();
        return $this->sendResponse($products, 'products retrieved successfully.');

    }
}
