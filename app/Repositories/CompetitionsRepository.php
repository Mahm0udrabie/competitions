<?php


namespace App\Repositories;


use App\Models\Competition;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Carbon\Carbon;

class CompetitionsRepository implements CompetitionsRepositoryInterface
{
    public function index() {
        $today=Carbon::parse(Carbon::today());
         return Competition::where('status', 1)
         ->whereDate('start','<=', $today)
         ->whereDate('end','>=', $today)
         ->latest()->get();
    }
    public function store($data)
    {
        $user = $data->user();
        if($user->isA('superadministrator'))
            return Competition::create($data->all());
    }
    public function show($id) {
        return Competition::findOrFail($id);
    }
    public function update($data,$id) {
        $isUpdate = Competition::findOrFail($id);
        if($isUpdate)
            return $isUpdate->update($data);
        return $isUpdate;
    }
    public function delete($id) {
        $isDeleted = Competition::findOrFail($id);
        if($isDeleted)
            return $isDeleted->delete();
        return $isDeleted;
    }
}
