<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PartitionRequest;
use App\Models\Partition;
use Illuminate\Http\Request;

class PartitionsController extends Controller
{
    public function index()
    {
        $partitions = Partition::all();
        return response()->json(['partitions' => $partitions], 200);
    }

    public function show(Partition $partition)
    {
        return response()->json(['partition' => $partition], 200);
    }

    public function store(PartitionRequest $request)
    {
        $partition = Partition::create($request->all());
        return response()->json(['partition' => $partition], 201);
    }

    public function update(PartitionRequest $request, Partition $partition)
    {
        $partition->update($request->all());
        return response()->json(['partition' => $partition], 200);
    }

    public function destroy(Partition $partition)
    {
        $partition->delete();
        return response()->json(["message" => "deleted successfully"], 200);
    }

    public function restore($id)
    {
        $partition = Partition::onlyTrashed()->findOrFail($id);
        $partition->restore();
        return response()->json(['partition' => $partition], 200);
    }
}
