<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\SearchRequest;
use App\Http\Requests\Product\StorProductRequests;
use App\Http\Requests\Product\updateProductRequests;
//use App\Http\Requests\User\updateUserRequests;
use App\Http\Resources\productResource;
use App\Http\Resources\RecentlyResource;
use App\Models\Favorites;
use App\Models\product;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\HttpFoundation\Response;

class productController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
        $this->middleware(['check_admin'])->only(['store', 'update', 'destroy']);
    }
    public function index()
    {
        $product = product::with('category')->paginate(5);
        return productResource::collection($product);
    }

    public function store(StorProductRequests $request)
    {
        $product_data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = 'products/' . uniqid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $product_data['image'] = $name;
        }

              product::create($product_data);
        // $user_id = auth()->user()->id;
        // $favorite_data['product_id'] = $product->id;
        // $favorite_data['user_id'] = $user_id;
        // $favorite_data['is_favorite'] = 0;
        // $favorite = Favorites::create($favorite_data);
        return response(__('insert successfully'), Response::HTTP_OK);
    }

    public function update(updateProductRequests $request, product $product)
    {
        
        $product_data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = 'products/' . uniqid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $product_data['image'] = $name;
        }
        $product->update($product_data);
        return $this->showOne($product, productResource::class, __('update successfully'), 200);
    }

    public function destroy(product $product)
    {
        $product->delete();

        return response(__('deleted successfully'), Response::HTTP_OK);
    }
    public function show(product $product)
    {

        return new productResource($product);
    }

    public function search_product(SearchRequest $request)
    {

        $query = product::where('trading_name', 'like', '%' . $request['trading_name'] . '%')->first();
        return new RecentlyResource($query);

    }
    public function addedRecently ()
    {
        $products = Product::with('category')
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    return RecentlyResource::collection($products);
    }
}
