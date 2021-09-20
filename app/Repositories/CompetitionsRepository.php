<?php


namespace App\Repositories;


use App\Models\Competition;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class CompetitionsRepository implements CompetitionsRepositoryInterface
{
    public function index() {
         return Competition::where('status', 1)->latest()->get();
    }
    public function store($data)
    {
        $user = $data->user();
        if($user->isA('superadministrator'))
            return Competition::create($data->all());
        return false;
    }
    public function show($id) {
        $competition = Competition::where('id', $id)->first();
        if($competition)
            return $competition;
        return 'competition does not exists';
    }
    public function update($data,$id) {
        $isUpdate = Competition::where('id', $id)->first();
        if($isUpdate)
            return $isUpdate->update($data);
        return 'invalid data';
    }
    public function delete($id) {
        $isDeleted = Competition::where('id', $id)->first();
        if($isDeleted)
            return $isDeleted->delete();
        return 'competition does not exists';
    }
}
