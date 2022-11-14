<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateAPIRequest;
use App\Http\Requests\StoreBookAPIRequest;
use App\Http\Requests\UpdateBookAPIRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookAPIController extends ApiBaseController
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
    public function index(PaginateAPIRequest $request): JsonResponse
    {
        //
        $books = Book::with('authors')->paginate(20);

        return $this->sendResponse(
            $books,
            "Retrieved successfully."
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

            return $this->sendResponse(
                $book,
                "Created successfully."
            );
        }

        return $this->sendError("Book exists.");
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

        $books = Book::with('authors')->find($id);

        if ($books->count() > 0) {
            return $this->sendResponse(
                $books,
                "Retrieved successfully.",
            );
        }
        return $this->sendError("Book Not Found");


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

        if (!is_null($book) && $book->count() > 0) {
            $book['title'] = $validated['title'];
            $book['subtitle'] = $validated['subtitle'] ?? null;
            $book->save();

            return $this->sendResponse(
                $book,
                "Updated successfully.",
            );
        }

        return $this->sendError("Unable to update: Book Not Found" );
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

        if (!is_null($book) && $book->count() > 0) {
            $book->delete();

            return $this->sendResponse(
                $destroyedBook,
                "Deleted successfully.",
            );
        }

        return $this->sendError("Unable to remove: Book Not Found");
    }

}
