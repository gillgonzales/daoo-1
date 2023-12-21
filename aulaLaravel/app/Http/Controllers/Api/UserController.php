<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->query('per_page');
        $usersPaginated = User::paginate($perPage);
        $usersPaginated->appends([
            'per_page' => $perPage
        ]);
        return response()->json($usersPaginated);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        try {
            $newUser = $request->all();
            $newUser['password'] = password_hash(
                $newUser['password'],
                PASSWORD_DEFAULT
            );
            $response = [
                'mensagem'=>'Usuário cadastrado com sucesso!!',
                'user'=>User::create($newUser)
            ];
            $status = 200;
        }catch (\Exception $error) {
            $status = 500;
            $response = ['error'=>$error->getMessage()];
        }
        return $response()->json($response, $status);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
