<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return response()->json(['items' => $items], 200);
    }

    public function show(Item $item)
    {
        return response()->json(['item' => $item], 200);
    }

    public function store(ItemRequest $request)
    {
        $item = Item::create($request->all());
        return response()->json(['item' => $item], 201);
    }

    public function update(ItemRequest $request, Item $item)
    {
        $item->update($request->all());
        return response()->json(['item' => $item], 200);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(["message" => "deleted successfully"], 200);
    }

    public function restore($id)
    {
        $item = Item::onlyTrashed()->findOrFail($id);
        $item->restore();
        return response()->json(['item' => $item], 200);
    }
}
