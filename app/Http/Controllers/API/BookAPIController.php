<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookAPIRequest;
use App\Http\Requests\UpdateBookAPIRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Get(
     *     path="/api/books",
     *     summary="Finds the list of all books ",
     *     @OA\Response(response="200", description="Browse the list of all books")
     * )
     */
    public function index()
    {
        //
        $books = Book::all();
        return response()->json(
            [
                'status' => true,
                'message' => "Retrieved successfully.",
                'data' => [
                    'books' => $books,
                ],
            ],
            200
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Post(
     *     path="/api/books",
     *     summary="Store new book",
     *     @OA\Parameter(name="title", in="query", description="Title of the book", @OA\Schema(type="string")),
     *     @OA\Parameter(name="subtitle", in="query", description="Subtitle of the book", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Successfully Store new books")
     * )
     */
    public function store(StoreBookAPIRequest $request)
    {
        //
        $validated = $request->validated();

        $book = Book::query()
            ->where('title', $request['title'])
            ->first();

        if (is_null($book)) {
            $book = Book::create($validated);

            $response = response()->json(
                [
                    'success' => true,
                    'message' => "Created successfully.",
                    'data' => [
                        'book' => $book,
                    ],
                ],
                200
            );
        } else {
            $response = response()->json(
                [
                    'status' => false,
                    'message' => "Book exists.",
                    'data' => [
                        'book' => $book,
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Get(
     *     path="/api/books/{id}",
     *     summary="Finds Books by book id",
     *     @OA\Parameter(name="id", in="path", description="Book id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Show selected Book"),
     *     @OA\Response(response="404", description="Show error when Book not Found")
     * )
     */
    public function show($id)
    {
        //
        $book = Book::query()
            ->where('id', $id)
            ->get();

        $response = response()->json(
            [
                'status' => false,
                'message' => "book Not Found",
                'data' => [
                    'books' => null,
                ],
            ],
            404  # Not Found
        );

        if ($book->count() > 0) {
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Retrieved successfully.",
                    'data' => [
                        'books' => $book,
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Patch(
     *     path="/api/books/{id}",
     *     summary="Update the book",
     *     @OA\Parameter(name="id", in="path", description="id of the book", @OA\Schema(type="int")),
     *     @OA\Parameter(name="title", in="query", description="Title of the book", @OA\Schema(type="string")),
     *     @OA\Parameter(name="subtitle", in="query", description="Subtitle of the book", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Update the book"),
     *     @OA\Response(response="404", description="Show error when book not Found")
     * )
     */
    public function update(UpdateBookAPIRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $book = Book::query()->where('id', $id)->first();

        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to update: Book Not Found",
                'book' => null
            ],
            404  # Not Found
        );

        if (!is_null($book) && $book->count() > 0) {
            $book['title'] = $validated['title'];
            $book['subtitle'] = $validated['subtitle'] ?? null;
            $book->save();
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Updated successfully.",
                    'book' => $book
                ],
                200  # Ok
            );
        }

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Delete(
     *     path="/api/books/{id}",
     *     summary="Delete the book",
     *     @OA\Parameter(name="id", in="path", description="Book id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Successfully delete the book"),
     *     @OA\Response(response="404", description="Show error when book not Found")
     * )
     */
    public function destroy($id)
    {
        //
        $book = Book::query()->where('id', $id)->first();

        $destroyedBook = $book;

        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to delete: Book Not Found",
                'authors' => null
            ],
            404  # Not Found
        );

        if (!is_null($book) && $book->count() > 0) {
            $book->delete();
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Book deleted.",
                    'authors' => $destroyedBook
                ],
                200  # Ok
            );
        }

        return $response;
    }

}
