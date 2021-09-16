<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Repositories\CompetitionsRepositoryInterface;
use App\Http\Requests\CompetitionRequest;

class CompetitionController extends Controller
{
    protected $competition;
    public function __construct(CompetitionsRepositoryInterface $competition) {
        $this->competition = $competition;
    }
    public function store(CompetitionRequest $request) {
        $competition = $this->competition->store($request->all());
        return response()->json([
            'status' => 'success',
            'data'   => $competition
        ]);
    }

}
