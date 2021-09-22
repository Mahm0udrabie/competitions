<?php


namespace App\Repositories;


interface ClubsRepositoryInterface
{
    public function store($data);
    public function getAll();
    public function show($id);
    public function update($data, $id);
    public function delete($id);
}
