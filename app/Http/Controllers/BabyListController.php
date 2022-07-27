<?php

namespace App\Http\Controllers;

use App\Http\Requests\BabyListRequest;
use App\Http\Requests\BabyStoreRequest;
use App\Models\BabyList;
use App\Services\BabyListService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection as Collection;
use Illuminate\Http\Response;

class BabyListController extends Controller
{
    public function __construct(private readonly BabyListService $babyListService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return Collection
     */
    public function index(BabyListRequest $request): Collection
    {
        return $this->babyListService->babyList($request->getUserId(), $request->get('search'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \app\Http\Requests\BabyStoreRequest  $request
     * @return JsonResponse
     */
    public function store(BabyStoreRequest $request): JsonResponse
    {
        $list = $this->babyListService->babyListStore($request->getData());

        return $this->responseJson($list, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BabyList  $babyList
     * @return Response
     */
    public function show(BabyList $babyList): Response|BabyList
    {
        return $babyList;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BabyList  $babyList
     * @return Response
     */
    public function update(Request $request, BabyList $babyList)
    {
        tap($babyList)->update($request->only(['success_yn','description','updated_at']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BabyList  $babyList
     * @return JsonResponse
     */
    public function destroy(BabyList $babyList): JsonResponse
    {
        $babyList->delete();
        return $this->responseJson(null, 204);
    }
}
