<?php

namespace App\Http\Controllers;

use App\Models\Set;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSetRequest;
use App\Http\Resources\SetResource;
use Illuminate\Support\Facades\Cache;


class SetController extends Controller
{
    /**
     * Listar sets
     *
     * Retorna uma lista paginada de sets, com suporte a filtros, busca e ordenação.
     *
     * @queryParam theme string Filtra por tema. Example: Star Wars
     * @queryParam year integer Filtra por ano. Example: 2019
     * @queryParam search string Busca por nome. Example: falcon
     * @queryParam sort_by string Campo para ordenação. Example: year
     * @queryParam sort_direction string Direção da ordenação. Example: desc
     * @queryParam page integer Página atual. Example: 1
     */    
    public function index(Request $request)
    {
        $cacheKey = 'sets:' . md5($request->fullUrl());

        $sets = Cache::remember($cacheKey, 60, function () use ($request) {
            $query = Set::query();

            if ($request->filled('theme')) {
                $query->where('theme', 'like', '%' . $request->theme . '%');
            }

            if ($request->filled('year')) {
                $query->where('year', $request->year);
            }

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            $sortBy = $request->get('sort_by', 'id');
            $sortDirection = $request->get('sort_direction', 'asc');

            $allowedSorts = ['id', 'name', 'year', 'num_parts'];

            if (! in_array($sortBy, $allowedSorts)) {
                $sortBy = 'id';
            }

            if (! in_array($sortDirection, ['asc', 'desc'])) {
                $sortDirection = 'asc';
            }

            return $query->orderBy($sortBy, $sortDirection)->paginate(10);
        });

        return SetResource::collection($sets);
    }
    /**
     * Criar um novo set.
     */
    public function store(StoreSetRequest $request)
    {
        $set = Set::create($request->validated());

        return response()->json($set, 201);
    }

    public function show(Set $set)
    {
        return new SetResource($set);
    }

    public function update(StoreSetRequest $request, Set $set)
    {
        $set->update($request->validated());

        return new SetResource($set);
    }

    public function destroy(Set $set)
    {
        $set->delete();

        return response()->json(null, 204);
    }
}