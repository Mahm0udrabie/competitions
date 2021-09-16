<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ClubRequest;
use App\Repositories\ClubsRepositoryInterface;

class ClubController extends Controller
{
    protected $club;
    public function __construct(ClubsRepositoryInterface $club) {
        $this->club = $club;
    }
    public function store(ClubRequest $request) {
        $team = $this->club->store($request->all());
        return response()->json([
            'status' => 'success',
            'data'   => $team
        ],200);
    }
    public function show($id) {
        $team = $this->club->show($id);
        return response()->json([
            'status' => 'success',
            'data'   => $team
        ]);
    }
    public function update(Request $request, $id) {
        $updatedTeam = $this->club->update($request->all(), $id);
        return response()->json([
            'status' => 'success',
            'data'   => $updatedTeam
        ]);
    }
    public function delete($id) {
        $deletedTeam = $this->club->delete($id);
        return response()->json([
            'status' => 'success',
            'data'   => $deletedTeam
        ]);
    }
    public function addMembers(Request $request) {
        $member = $this->club->addMembers($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $member
        ]);
    }

}
