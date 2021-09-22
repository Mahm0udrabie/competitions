<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UsersResource;

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
    public function getAllUsers() {
        $users = $this->userRepository->getAllUsers();
        return response()->json([
            'status' => 'success',
            'data'   => UsersResource::collection($users)
        ]);
    }
    public function getUser($id) {
        $user = $this->userRepository->getUser($id);
        return response()->json([
            'status' => 'success',
            'data'   => new UsersResource($user)
        ]);
    }
    public function getAllUsersByClub($id) {
        $user = $this->userRepository->getAllUsersByClub($id);
        return response()->json([
            'status' => 'success',
            'data'   => UsersResource::collection($user)
        ]);
    }
    public function delete($id) {
        $isDeleted= $this->userRepository->delete($id);
        return response()->json([
            'status' => 'success',
            'data'   => $isDeleted
        ]);
    }
}
