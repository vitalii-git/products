<?php

namespace App\Http\Controllers;

use App\Http\Requests\Goods\CreateGoodsRequest;
use App\Http\Requests\Goods\UpdateGoodsRequest;
use App\Http\Resources\GoodsResource;
use App\Services\Goods\GoodsService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class GoodsController
 * @package App\Http\Controllers
 */
class GoodsController extends Controller
{
    /**
     * @var GoodsService
     */
    private $service;

    /**
     * GoodsController constructor.
     * @param GoodsService $goodsService
     */
    public function __construct(GoodsService $goodsService)
    {
        $this->service = $goodsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        return GoodsResource::collection($this->service->getAllPaginated($request->all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateGoodsRequest $request
     * @return GoodsResource
     */
    public function store(CreateGoodsRequest $request)
    {
        return GoodsResource::make($this->service->create($request->validated()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return GoodsResource
     */
    public function show($id)
    {
        return GoodsResource::make($this->service->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateGoodsRequest $request
     * @param int $id
     * @return GoodsResource
     */
    public function update(UpdateGoodsRequest $request, $id)
    {
        return GoodsResource::make($this->service->update($id, $request->validated()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
