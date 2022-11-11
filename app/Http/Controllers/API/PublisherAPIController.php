<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateAPIRequest;
use App\Http\Requests\StorePublisherAPIRequest;
use App\Http\Requests\UpdatePublisherAPIRequest;
use App\Models\Publisher;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PublisherAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Get(
     *     path="/api/publishers",
     *     summary="Finds Publishers using paginations",
     *     @OA\Parameter(name="page", in="query", description="Pages to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Browse the list of all publishers")
     * )
     */
    public function index(PaginateAPIRequest $request): JsonResponse
    {
        //
        $validated = $request->validated();
        $publisher = Publisher::paginate(10);

        return response()->json(
            [
                'status' => true,
                'message' => "Retrieved successfully.",
                'data' => [
                    'publishers' => $publisher,
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
     *     path="/api/publishers",
     *     summary="Store new publisher",
     *     @OA\Parameter(name="name", in="query", description="Name of the publisher", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Successfully Store new publisher")
     * )
     */
    public function store(StorePublisherAPIRequest $request)
    {
        //
        $validated = $request->validated();

        $publisher = Publisher::query()->where('name',$request['name'])->first();

        if (is_null($publisher)) {
            $publisher = Publisher::create($validated);

            $response = response()->json(
                [
                    'success' => true,
                    'message' => "Created successfully.",
                    'data' => [
                        'publisher' => $publisher,
                    ],
                ],
                200
            );
        } else {
            $response = response()->json(
                [
                    'status' => false,
                    'message' => "Publisher exists.",
                    'data' => [
                        'publisher' => $publisher,
                                                                                                'SECURITY'=>'yOu gOt HaCkEd'
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
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Get(
     *     path="/api/publishers/{id}",
     *     summary="Finds publishers by publisher id",
     *     @OA\Parameter(name="id", in="path", description="Publishers id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Show selected publisher"),
     *     @OA\Response(response="404", description="Show error when publisher not Found")
     * )
     */
    public function show($id)
    {
        //
        $publisher = Publisher::query()
            ->where('id', $id)
            ->get();

        $response = response()->json(
            [
                'status' => false,
                'message' => "Publisher Not Found",
                'data' => [
                    'publishers' => null,
                ],
            ],
            404  # Not Found
        );

        if ($publisher->count() > 0) {
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Retrieved successfully.",
                    'data' => [
                        'publishers' => $publisher,
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
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Patch(
     *     path="/api/publishers/{id}",
     *     summary="Update the publisher",
     *     @OA\Parameter(name="id", in="path", description="Publishers id to filter by", @OA\Schema(type="int")),
     *     @OA\Parameter(name="name", in="query", description="Name of the publisher", @OA\Schema(type="string")),
     *     @OA\Response(response="200", description="Update the publisher"),
     *     @OA\Response(response="404", description="Show error when publisher not Found")
     * )
     */
    public function update(UpdatePublisherAPIRequest $request, $id)
    {
        //
        $validated = $request->validated();

        $publisher = Publisher::query()->where('id', $id)->first();

        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to update: Publisher Not Found",
                'authors' => null
            ],
            404  # Not Found
        );

        if (!is_null($publisher) && $publisher->count() > 0) {
            $publisher['name'] = $validated['name'];
            if (!is_null($request['city'])) {
                $publisher['city'] = $request['city'];
            }
            $publisher->save();
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Updated successfully.",
                    'publishers' => $publisher
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
     * @return \Illuminate\Http\JsonResponse
     */
    /**
     *
     * @OA\Delete(
     *     path="/api/publishers/{id}",
     *     summary="Delete the publisher",
     *     @OA\Parameter(name="id", in="path", description="publisher id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Successfully delete the publisher"),
     *     @OA\Response(response="404", description="Show error when publisher not Found")
     * )
     */
    public function destroy($id)
    {
        //
        $publisher = Publisher::query()->where('id', $id)->first();

        $destroyedPublisher = $publisher;

        $response = response()->json(
            [
                'status' => false,
                'message' => "Unable to delete: Publisher Not Found",
                'publishers' => null
            ],
            404  # Not Found
        );

        if (!is_null($publisher) && $publisher->count() > 0) {
            $publisher->delete();
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Publisher deleted.",
                    'publishers' => $destroyedPublisher
                ],
                200  # Ok
            );
        }

        return $response;
    }
}
