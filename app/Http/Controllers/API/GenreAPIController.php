<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGenreAPIRequest;
use App\Http\Requests\UpdateGenreAPIRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreAPIController extends ApiBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Get(
     *     path="/api/genres",
     *     summary="Finds the list of all genres ",
     *     @OA\Response(response="200", description="Browse the list of all genres")
     * )
     */
    public function index()
    {
        //
        $genres = Genre::all();

        if (!is_null($genres)) {
            return $this->sendResponse(
                $genres,
                "Retrieved successfully."
            );
        }

        return $this->sendError("Genre not exists.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Post(
     *     path="/api/genres",
     *     summary="Store new genre",
     *     @OA\Parameter(name="name", in="query", description="name of the genre", @OA\Schema(type="string")),
     *     @OA\Parameter(name="description", in="query", description="description of the genre", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Successfully Store new genre")
     * )
     */
    public function store(StoreGenreAPIRequest $request)
    {
        //
        $validated = $request->validated();

        $genre = Genre::query()
            ->where('name', $request['name'])
            ->first();

        if (is_null($genre)) {
            $genre = Genre::create($validated);

            return $this->sendResponse(
                $genre,
                "Created successfully."
            );
        }

        return $this->sendError("Genre exists.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Get(
     *     path="/api/genres/{id}",
     *     summary="Finds genre by genre id",
     *     @OA\Parameter(name="id", in="path", description="Genre id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Show selected genre"),
     *     @OA\Response(response="404", description="Show error when genre not Found")
     * )
     */
    public function show($id)
    {
        //
        $genre = Genre::query()
            ->where('id', $id)
            ->get();

        if ($genre->count() > 0) {
            return $this->sendResponse(
                $genre,
                "Retrieved successfully.",
            );
        }
        return $this->sendError("Genre Not Found");

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Patch(
     *     path="/api/genres/{id}",
     *     summary="Update the genre",
     *     @OA\Parameter(name="id", in="path", description="id of the genre", @OA\Schema(type="int")),
     *     @OA\Parameter(name="name", in="query", description="name of the genre", @OA\Schema(type="string")),
     *     @OA\Parameter(name="description", in="query", description="description of the genre", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Update the genre"),
     *     @OA\Response(response="404", description="Show error when genre not Found")
     * )
     */
    public function update(UpdateGenreAPIRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $genre = Genre::query()->where('id', $id)->first();

        if (!is_null($genre) && $genre->count() > 0) {
            $genre['name'] = $validated['name'];
            $genre['description'] = $validated['description'] ?? null;

            $genre->save();

            return $this->sendResponse(
                $genre,
                "Updated successfully.",
            );
        }
        return $this->sendError("Unable to update: Genre Not Found" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Delete(
     *     path="/api/genres/{id}",
     *     summary="Delete the genre",
     *     @OA\Parameter(name="id", in="path", description="Genre id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Successfully delete the genre"),
     *     @OA\Response(response="404", description="Show error when genre not Found")
     * )
     */
    public function destroy($id)
    {
        //
        $genre = Genre::query()->where('id', $id)->first();

        $destroyedGenre = $genre;

        if (!is_null($genre) && $genre->count() > 0) {
            $genre->delete();

            return $this->sendResponse(
                $destroyedGenre,
                "Deleted successfully.",
            );
        }

        return $this->sendError("Unable to remove: Genre Not Found");
    }
}
