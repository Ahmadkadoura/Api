<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StorUserRequests;
use App\Http\Requests\User\updateUserRequests;
use App\Http\Resources\UserResource;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

//use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'check_admin']);
    }
    public function index()
    {
        $users = User::paginate(5);

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorUserRequests $request)
    {
        $user_data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = 'users/' . uniqid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $user_data['image'] = $name;
        }
        $user = User::create($user_data);
        return $this->showOne($user, UserResource::class, __('insert successfully'), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateUserRequests $request, User $user)
    {
        $user_data = $request->validated();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = 'users/' . uniqid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $user_data['image'] = $name;
        }
        $user->update($user_data);
        return $this->showOne($user, UserResource::class, __('update successfully'), 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response(__('deleted successfully'), Response::HTTP_OK);
    }
}
