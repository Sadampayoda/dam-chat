<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use App\Repository\BaseQueryRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(BaseQueryRepository $baseQueryRepository)
    {
        $this->user = $baseQueryRepository;
        $this->user->setModel(User::class);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 202,
            'data' => $this->user->all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $validate = $request->only(['name', 'password']);
            $data = $this->user->create($validate);
            return response()->json([
                'success' => true,
                'message' => 'Akunmu sudah terbuat hehe',
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Hmmm Akunmu gagal terbuat',
                'data' => $th,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function where(Request $request)
    {
        $data = $this->user->where($request->all());
        if (!$data) {
            return response()->json([
                'status' => 404,
                'data' => [],
                'message' => 'Data Not Found',
            ]);
        }


        return response()->json([
            'status' => 200,
            'data' => $data,
        ]);
    }

    public function auth(Request $request)
    {
        return $request->all();
    }
}
