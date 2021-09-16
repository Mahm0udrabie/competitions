<?php


namespace App\Repositories;


use App\Models\Competition;

class CompetitionsRepository implements CompetitionsRepositoryInterface
{
    public function store($data)
    {
        return Competition::create($data);
    }
}
