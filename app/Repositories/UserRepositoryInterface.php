<?php


namespace App\Repositories;


interface UserRepositoryInterface
{
    public function store($datas);
    public function getAllUsers();
    public function AllUsersWithoutRole();
    public function AllUsersWithRole();
    public function UserWithRole($id);
    public function getUser($id);
}
