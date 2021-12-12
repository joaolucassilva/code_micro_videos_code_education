<?php

namespace App\Http\Controllers\Api;

use App\Models\Genre;
use App\Http\Requests\Genre\{
    GenreStoreRequest,
    GenreUpdateRequest
};
use App\Http\Controllers\Controller;


class GenreController extends Controller
{
    public function index()
    {
        return Genre::all();
    }

    public function store(GenreStoreRequest $request)
    {
        $genre = Genre::create($request->validated());
        $genre->refresh();
        return $genre;
    }

    public function show(Genre $genre)
    {
        return $genre;
    }

    public function update(GenreUpdateRequest $request, Genre $genre)
    {
        $genre->update($request->validated());
        $genre->fresh();
        return $genre;
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();
        return response()->noContent();
    }
}
