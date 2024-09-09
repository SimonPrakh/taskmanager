<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = auth()->user()->teams; // Получение команд текущего пользователя
        return response()->json($teams, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team = Team::create([
            'name' => $request->name,
        ]);

        $team->users()->attach(auth()->id()); // Добавление текущего пользователя в команду

        return response()->json($team, 201);
    }

    public function addUser(Request $request, $teamId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $team = Team::findOrFail($teamId);
        $team->users()->attach($request->user_id);

        return response()->json(['message' => 'User added to team'], 200);
    }

    public function removeUser($teamId, $userId)
    {
        $team = Team::findOrFail($teamId);
        $team->users()->detach($userId);

        return response()->json(['message' => 'User removed from team'], 200);
    }
}
