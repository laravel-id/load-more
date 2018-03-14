<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\User;

class UserController extends Controller
{
    /**
     * Show all users separated by pagination.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $users = User::orderBy('name')
            ->simplePaginate((int) $request->get('limit', 20));

        return response()
            ->json($users)
            ->withCallback($request->callback);
    }
}
