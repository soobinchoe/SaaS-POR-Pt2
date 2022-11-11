<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAuthorAPIRequest;
use App\Http\Requests\UpdateAuthorAPIRequest;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthorAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Get(
     *     path="/api/authors",
     *     summary="Finds the list of all authors ",
     *     @OA\Response(response="200", description="Browse the list of all authors")
     * )
     */
    public function index()
    {
        //
        $authors = Author::all();
        return response()->json(
            [
                'status' => true,
                'message' => "Retrieved successfully.",
                'data' => [
                    'authors' => $authors,
                ],
            ],
            200
        );
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
     *     path="/api/authors",
     *     summary="Store new author",
     *     @OA\Parameter(name="given_name", in="query", description="given name of the author", @OA\Schema(type="string")),
     *     @OA\Parameter(name="family_name", in="query", description="family name of the book", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Successfully Store new author")
     * )
     */
    public function store(StoreAuthorAPIRequest $request)
    {
        //

        $validated = $request->validated();

        $author = Author::query()
            ->where('given_name', $request['given_name'])
            ->where('family_name', $request['family_name'])
            ->first();


        if (is_null($author)) {
            $validated['is_company'] = $validated['is_company'] ?? 0; // Default to false

             if (!isset($validated['family_name']) ) {
                 $validated['family_name'] = $validated['given_name'];
                 $validated['given_name'] = null;
             }


            $author = Author::create($validated);

            $response = response()->json(
                [
                    'success' => true,
                    'message' => "Created successfully.",
                    'data' => [
                        'authors' => $author,
                    ],
                ],
                200
            );
        } else {
            $response = response()->json(
                [
                    'status' => false,
                    'message' => "Author exists.",
                    'data' => [
                        'authors' => $author,
                    ],
                ],
                202
            );
        }

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Get(
     *     path="/api/authors/{id}",
     *     summary="Finds authors by author id",
     *     @OA\Parameter(name="id", in="path", description="Author id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Show selected Author"),
     *     @OA\Response(response="404", description="Show error when Author not Found")
     * )
     */
    public function show($id)
    {
        //
        $author = Author::query()
            ->where('id', $id)
            ->get();

        $response = response()->json(
            [
                'status' => false,
                'message' => "Author Not Found",
                'data' => [
                    'authors' => null,
                ],
            ],
            404  # Not Found
        );

        if ($author->count() > 0) {
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Retrieved successfully.",
                    'data' => [
                        'authors' => $author,
                    ],
                ],
                200  # Ok
            );
        }
        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Patch(
     *     path="/api/authors/{id}",
     *     summary="Update the author",
     *     @OA\Parameter(name="id", in="path", description="id of the author", @OA\Schema(type="int")),
     *     @OA\Parameter(name="given_name", in="query", description="given name of the author", @OA\Schema(type="string")),
     *     @OA\Parameter(name="family_name", in="query", description="family name of the book", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Update the author"),
     *     @OA\Response(response="404", description="Show error when author not Found")
     * )
     */
    public function update(UpdateAuthorAPIRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $author = Author::query()->where('id', $id)->first();

        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to update: Author Not Found",
                'authors' => null
            ],
            404  # Not Found
        );

        if (!is_null($author) && $author->count() > 0) {
            $validated['is_company'] = $validated['is_company'] ?? 0;
            if (!isset($validated['family_name']) ) {
                $validated['family_name'] = $validated['given_name'];
                $validated['given_name'] = null;
            }

            $author['given_name'] = $validated['given_name'];
            $author['family_name'] = $validated['family_name'];
            $author['is_company'] = $validated['is_company'];
            $author['updated_at'] = Carbon::now();
            $author->save();
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Updated successfully.",
                    'authors' => $author
                ],
                200  # Ok
            );
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Delete(
     *     path="/api/authors/{id}",
     *     summary="Delete the author",
     *     @OA\Parameter(name="id", in="path", description="Author id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Successfully delete the author"),
     *     @OA\Response(response="404", description="Show error when author not Found")
     * )
     */
    public function destroy($id)
    {
        //
        $author = Author::query()->where('id', $id)->first();

        $destroyedAuthor = $author;

        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to delete: Author Not Found",
                'authors' => null
            ],
            404  # Not Found
        );

        if (!is_null($author) && $author->count() > 0) {
            $author->delete();
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Author deleted.",
                    'authors' => $destroyedAuthor
                ],
                200  # Ok
            );
        }

        return $response;

    }
}
