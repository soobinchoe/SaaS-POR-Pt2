<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginateAPIRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class UserAPIController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /**
     *
     * @OA\Get(
     *     path="/api/users",
     *     summary="Finds Users using paginations",
     *     @OA\Parameter(name="page", in="query", description="Pages to filter by", @OA\Schema(type="int")),
     *     @OA\Parameter(name="per_page", in="query", description="Number of users per pages to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Browse the list of all users")
     * )
     */
    public function index(PaginateAPIRequest $request): JsonResponse
    {
        //

//        $user = User::all();
        $validated = $request->validated();
        $users = User::paginate($validated['per_page']);

        return response()->json(
            [
                'status' => true,
                'message' => "Retrieved successfully.",
                'data' => [
                    'users' => $users,
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
        return response()->json(
            [
                'status' => false,
                'message' => "Can't add.",
                'data' => [
                    'users' => null,
                ],
            ],
            404  # Not Found
        );
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
     *     path="/api/users/{id}",
     *     summary="Finds Users by user id",
     *     @OA\Parameter(name="id", in="path", description="User id to filter by", @OA\Schema(type="int")),
     *     @OA\Response(response="200", description="Show selected user"),
     *     @OA\Response(response="404", description="Show error when user not Found")
     * )
     */
    public function show($id)
    {
        //
        $user = User::query()
            ->where('id', $id)
            ->get();

        $response = response()->json(
            [
                'status' => false,
                'message' => "User Not Found",
                'data' => [
                    'users' => null,
                ],
            ],
            404  # Not Found
        );

        if ($user->count() > 0) {
            $response = response()->json(
                [
                    'status' => true,
                    'message' => "Retrieved successfully.",
                    'data' => [
                        'users' => $user,
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
    public function update(Request $request, $id)
    {
        //
        return response()->json(
            [
                'status' => false,
                'message' => "Can't update.",
                'data' => [
                    'users' => null,
                ],
            ],
            404  # Not Found
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return response()->json(
            [
                'status' => false,
                'message' => "Can't delete.",
                'data' => [
                    'users' => null,
                ],
            ],
            404  # Not Found
        );
    }
}
