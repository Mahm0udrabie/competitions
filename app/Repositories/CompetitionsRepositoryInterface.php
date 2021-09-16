<?php


namespace App\Repositories;


interface CompetitionsRepositoryInterface
{
    public function store($data);
    public function show($id);
    public function update($data, $id);
    public function delete($id);
}
