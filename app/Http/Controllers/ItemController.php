<?php

namespace App\Http\Controllers;

use App\Models\Checklist;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function store(Request $request, Checklist $checklist)
    {
        $this->authorize('update', $checklist);

        $validated = $request->validate(['name' => 'required|string']);
        $item = $checklist->items()->create($validated);
        return response()->json($item, 201);
    }

    public function update(Request $request, Checklist $checklist, Item $item)
    {
        $this->authorize('update', $checklist);

        $validated = $request->validate(['name' => 'sometimes|string', 'is_done' => 'sometimes|boolean']);
        $item->update($validated);
        return response()->json($item);
    }

    public function show(Checklist $checklist, Item $item)
    {
        $this->authorize('update', $checklist);
        return response()->json($item);
    }

    public function destroy(Checklist $checklist, Item $item)
    {
        $this->authorize('update', $checklist);
        $item->delete();
        return response()->json(['message' => 'Item deleted']);
    }
}
