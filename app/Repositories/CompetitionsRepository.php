<?php


namespace App\Repositories;


use App\Models\Competition;

class CompetitionsRepository implements CompetitionsRepositoryInterface
{
    public function store($data)
    {
        return Competition::create($data);
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
