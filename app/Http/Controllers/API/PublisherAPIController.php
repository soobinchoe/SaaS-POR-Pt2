<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePublisherAPIRequest;
use App\Models\Publisher;
use Illuminate\Http\Request;

class PublisherAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $publisher = Publisher::all();
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
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
