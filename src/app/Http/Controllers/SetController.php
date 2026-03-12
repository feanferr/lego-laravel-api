<?php

namespace App\Http\Controllers;

use App\Models\Set;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSetRequest;
use App\Http\Resources\SetResource;


class SetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SetResource::collection(Set::all());
    }    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSetRequest $request)
    {
        $set = Set::create($request->validated());

        return response()->json($set, 201);
    }
    /**
     * Display the specified resource.
     */
    public function show(Set $set)
    {
        $set = Set::findOrFail($id);

        return new SetResource($set);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Set $set)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Set $set)
    {
        $set = Set::findOrFail($id);
        $set->update($request->all());

        return $set;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Set $set)
    {
        Set::destroy($id);

        return response()->json(null, 204);
    }
}
