<?php


namespace App\Repositories;


interface ConfigurationRepositoryInterface
{
    public function setConfigurations($data);
    public function getConfigurations();
}
