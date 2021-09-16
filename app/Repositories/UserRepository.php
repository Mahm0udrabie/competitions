<?php


namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function store($data)
    {
        $user = new User;
        $user->fill($data);
        $user->password = bcrypt($user->password);
        $user->save();

        if(isset($data['role_id'])){
            $user->attachRole($data['role_id']);
        }

        return $user;
    }
    public function AllUsersWithoutRole()
    {
        $users = User::with("roles")->select('id', 'name', 'email')
            ->whereNotIn("id", DB::table('role_user')
                ->pluck("user_id")->toArray())->get();
        return $users;
    }
    public function AllUsersWithRole()
    {
        $users = User::whereHas('roles')->get();
        return $users;
    }
    public function UserWithRole($id)
    {
        $user = User::where("id", $id)->first();
        return $user;
    }    
    public function getUserWithRole($id)
    {
        $user = User::with("roles")->where("id",$id)->first();
        return $user;
    }
}
