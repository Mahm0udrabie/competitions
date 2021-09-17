<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    protected $userRepository;
    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository =  $userRepository;
    }
    public function store(UserRequest $request) {
        $user = $this->userRepository->store($request->all());
        return response()->json([
            'status' => 'success',
            'data'   => $user
        ]);
    }
    public function AllUsersWithRole() {
        $users = $this->userRepository->AllUsersWithRole();
        return response()->json([
            'status' => 'success',
            'data'   => $users
        ]);
    }
}
