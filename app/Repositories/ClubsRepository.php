<?php


namespace App\Repositories;


use App\Models\Club;
use App\Models\User;
use App\Models\Role;

class ClubsRepository implements ClubsRepositoryInterface
{
    public function store($data)
    {
        return Club::create($data);
    }
    public function show($id) {
        $competition = Club::where('id', $id)->first();
        if($competition) 
            return $competition;
        return 'club does not exists';
    }
    public function update($data,$id) {
        $isUpdate = Club::where('id', $id)->first();
        if($isUpdate) 
            return $isUpdate->update($data);
        return 'invalid data';
    }
    public function delete($id) {
        $isDeleted = Club::where('id', $id)->first();
        if($isDeleted) 
            return $isDeleted->delete();
        return 'club does not exists';
    }
    public function addMembers($data)
    {
        $normalUser = Role::where('name', 'user')->first();
        $user = new User;
        $user->fill($data);
        $user->password = bcrypt('12345678');
        $user->save();
        $user->attachRole($normalUser->id);
        return $user;
    }
}
