<?php


namespace App\Repositories;


use App\Models\Club;
use App\Models\User;
use App\Models\Role;

class ClubsRepository implements ClubsRepositoryInterface
{
    public function store($data)
    {
        $user = auth()->user();
        $role = optional(auth()->user()->roles()->first())->name;
        $data['user_id'] = $user->id;
        if($role == 'administrator' && !$user->club()->exists()) {
            $club = Club::create($data);
            $user->update(['club_id'=>  $club->id]);
            return $club;
        }
        else if($role == 'superadministrator') {
            $data['status'] = 1;
            return Club::create($data);
        }
    }
    public function show($id) {
        return Club::findOrFail($id);
    }
    public function update($data,$id) {
        $isUpdated= Club::findOrFail($id);
        if($isUpdated)
            return $isUpdated->update($data);
        return $isUpdated;
    }
    public function delete($id) {
        $isDeleted = Club::findOrFail($id);
        if($isDeleted)
            return $isDeleted->delete();
        return $isDeleted ;
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
    public function getAll() {
        return Club::orderBy('id', 'desc')->get();
    }
    public function getCompetitionClubs($id) {
        return Club::where('status', 1)->where('competition_id', $id)->get();
    }
}
