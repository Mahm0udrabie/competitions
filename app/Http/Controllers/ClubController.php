<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ClubRequest;
use App\Http\Requests\UpdateClubRequest;
use App\Repositories\ClubsRepositoryInterface;
use App\Http\Resources\ClubResource;
use App\Repositories\UserRepositoryInterface;
use App\Http\Requests\MemberRequest;

class ClubController extends Controller
{
    protected $club;
    protected $user;
    public function __construct(ClubsRepositoryInterface $club, UserRepositoryInterface $user) {
        $this->club = $club;
        $this->user = $user;
    }
    public function store(ClubRequest $request) {
        $team = $this->club->store($request->all());
        if($team) {
            return response()->json([
                'status' => 'success',
                'data'   => $team
            ],200);
        } else {
            return response()->json([
                'message' => 'not allowed to create multiple teams',
            ],405);
        }

    }
    public function getAll() {
        $teams = $this->club->getAll();
        return response()->json([
            'status' => 'success',
            'data'   => ClubResource::collection($teams)
        ]);
    }
    public function show($id) {
        $team = $this->club->show($id);
        return response()->json([
            'status' => 'success',
            'data'   => new ClubResource($team)
        ]);
    }
    public function update(UpdateClubRequest $request, $id) {
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
    public function addMembers(MemberRequest $request) {
        $member = $this->club->addMembers($request->all());
        return response()->json([
            'status' => 'success',
            'data' => $member
        ]);
    }
    public function getCompetitionClubs($id) {
        $teams = $this->club->getCompetitionClubs($id);
        return response()->json([
            'status' => 'success',
            'data' =>  ClubResource::collection($teams)
        ]);
    }
}
