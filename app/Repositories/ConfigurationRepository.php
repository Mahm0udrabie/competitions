<?php


namespace App\Repositories;

use App\Models\Configuration;

class ConfigurationRepository implements ConfigurationRepositoryInterface
{
    public function setConfigurations($data)
    {
        $config =  Configuration::first();
        return $config->update($data) ?? $config;
    }
    public function getConfigurations() {
        return Configuration::first();
    }
}
