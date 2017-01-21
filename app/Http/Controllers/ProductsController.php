<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Products;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get all data from products
     */
    public function index(Request $request)
    {
        $products = new Products;
        $res['success'] = true;
        $res['result'] = $products->all();
        return response($res);
    }

    /**
     * Insert database for products
     * Url : /products/create
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'product_code' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);

        $products = Products::create([
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'quantity' => $request->input('quantity'),
            'selling_price' => $request->input('selling_price'),
        ]);

        $res['success'] = true;
        $res['message'] = 'Success create product';
        $res['data'] = $products;
        return response($res);
    }
    /**
     * Get one data products by id
     * Url : /products/{id}
     */
    public function read(Request $request, $id)
    {
        $products = Products::where('id', $id)->first();

        if ($products === null) {
            $res['success'] = false;
            $res['result'] = 'Product not found!';
            return response($res);
        } else {
            $res['success'] = true;
            $res['result'] = $products;
            return response($res);
        }
    }
    /**
     * Update data products by id
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_code' => 'required',
            'product_name' => 'required',
            'quantity' => 'required|numeric',
            'selling_price' => 'required|numeric',
        ]);

        $products = Products::where('id', $id)->update([
            'product_code' => $request->input('product_code'),
            'product_name' => $request->input('product_name'),
            'quantity' => $request->input('quantity'),
            'selling_price' => $request->input('selling_price'),
        ]);

        if ($products == 0) {
            $res['success'] = false;
            $res['result'] = 'No product updated';
            return response($res);
        } else {
            $res['success'] = true;
            $res['result'] = 'Success update id '.$id;
            return response($res);
        }
    }
    /**
     * Delete data products by id
     */
    public function delete(Request $request, $id)
    {
        $products = Products::find($id);
        if ($products === null) {
            $res['success'] = false;
            $res['result'] = 'Product not found!';
            return response($res);
        } else {
            if ($products->delete($id)) {
                $res['success'] = true;
                $res['result'] = 'Success delete product!';
                return response($res);
            }
        }
    }
}