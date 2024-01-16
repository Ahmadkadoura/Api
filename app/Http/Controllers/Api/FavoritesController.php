<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\FavoriteRequest;
use App\Http\Requests\product\SearchRequest;
use App\Http\Resources\favoriteProductResource;
use App\Models\Favorites;
use App\Models\product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum']);
    }
    public function index()
    {
        $user_id = auth()->user()->id;
        $favorite = Favorites::with('product')
            ->where('is_favorite', 1)->where('user_id', $user_id)->paginate(5);
        return favoriteProductResource::collection($favorite);
    }
    public function store(FavoriteRequest $request)
    {
        $user_id = auth()->user()->id;
        $product_id = $request->input('product_id');
        $favorite = Favorites::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();


        if ($favorite) {
            $favorite_data = $request->validated();
            $favorite_data['is_favorite']=1;
            $favorite->update($favorite_data);
        } else {
            $favorite_data = $request->validated();
            $favorite_data['user_id'] = $user_id;
            $favorite_data['is_favorite'] = 1;
            $favorite = Favorites::create($favorite_data);
        }

        return $this->showOne($favorite, FavoriteProductResource::class, __('insert successfully'), 200);
    }


    public function destroy(Favorites  $favorite)
    {
        $favorite->delete();
        return response(__('deleted successfully'), Response::HTTP_OK);
    }
}
