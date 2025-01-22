<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Item;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'You must be logged in to access this resource.',
            ], 401);
        }

        $checklists = auth()->user()->checklists()->with('items')->get();
        return response()->json($checklists);
    }

    public function store(Request $request)
    {
        $validated = $request->validate(['title' => 'required|string']);
        $checklist = auth()->user()->checklists()->create($validated);
        return response()->json($checklist, 201);
    }

    public function update(Request $request, $id)
    {
        $checklist = Checklist::find($id);
        if (!$checklist) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found.',
            ], 404);
        }
        $validated = $request->validate(['title' => 'sometimes|string']);
        $checklist->update($validated);
        return response()->json([
            'success' => true,
            'data' => $checklist,
        ]);
    }

    public function show($id)
    {
        $checklist = Checklist::with('items')->find($id);
        if (!$checklist) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found.',
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $checklist,
        ]);
    }

    public function destroy($id)
    {
        $checklist = Checklist::with('items')->find($id);
        if (!$checklist) {
            return response()->json([
                'success' => false,
                'message' => 'Checklist not found.',
            ], 404);
        }
        $checklist->delete();
        return response()->json([
            'success' => true,
            'message' => 'Checklist deleted.',
        ]);
    }
}
