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
