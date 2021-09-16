<?php

namespace App\Http\Controllers;
use App\Repositories\CompetitionsRepositoryInterface;
use App\Http\Requests\CompetitionRequest;
use App\Http\Requests\UpdateCompetitionRequest;

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
        ],200);
    }
    public function show($id) {
        $competition = $this->competition->show($id);
        return response()->json([
            'status' => 'success',
            'data'   => $competition
        ]);
    }
    public function update(UpdateCompetitionRequest $request, $id) {
        $updatedCompetition = $this->competition->update($request->all(), $id);
        return response()->json([
            'status' => 'success',
            'data'   => $updatedCompetition
        ]);
    }
    public function delete($id) {
        $deletedCompetition = $this->competition->delete($id);
        return response()->json([
            'status' => 'success',
            'data'   => $deletedCompetition
        ]);
    }

}
