<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\ConfigurationRepositoryInterface;
use App\Http\Requests\ConfigurationRequest;

class ConfigurationController extends Controller
{
    protected $config;
    public function __construct(ConfigurationRepositoryInterface $config) {
        $this->config = $config;
    }
    public function setConfigurations(ConfigurationRequest $request) {
        $config = $this->config->setConfigurations($request->all());
            return response()->json([
                'status' => 'success',
                'data'   => $config
            ],200);
    }
    public function getConfigurations() {
        $config = $this->config->getConfigurations();
            return response()->json([
                'status' => 'success',
                'data'   => $config
            ],200);
    }
}
