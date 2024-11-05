<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/items",
     *     tags={"Items"},
     *     summary="List All Items",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response="200",
     *         description="İtemleri listeler.",
     *         @OA\JsonContent()
     *     ),
     * )
     */
    public function index()
    {
        $items = Item::all();
        return $items;
    }

    /**
     * @OA\Post(
     *      path="/api/item",
     *      tags={"Items"},
     *      summary="Create Item",
     *      security={{"bearerAuth":{}}},
     *      description="Item oluştur",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"name", "description", "quantity"},
     *            @OA\Property(
     *              property="name",
     *              type="string",
     *              format="string",
     *              example="name"
     *              ),
     *            @OA\Property(
     *              property="description",
     *              type="string",
     *              format="string",
     *              example="description"
     *              ),
     *            @OA\Property(
     *              property="quantity",
     *              type="integer",
     *              format="integer",
     *              example="123"
     *              ),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                property="status",
     *                type="integer",
     *                 example=""
     *                 ),
     *             @OA\Property(
     *                property="data",
     *               type="object"
     *               )
     *          )
     *       )
     *  )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->name = $request->name;
        $item->description = $request->description;
        $item->quantity = $request->quantity;
        $item->save();
        return response()->json(['message' => 'Kaydetme işlemi başarılı']);
    }

    /**
     * @OA\Get(
     *      path="/api/item/{id}",
     *      tags={"Items"},
     *      summary="Show Item",
     *      security={{"bearerAuth":{}}},
     *      description="Item görüntüle",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of Item",
     *          required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                property="status",
     *                type="integer",
     *                 example=""
     *                 ),
     *             @OA\Property(
     *                property="data",
     *               type="object"
     *               )
     *          )
     *       )
     *  )
     *
     * @return JsonResponse
     */
    public function show(string $id)
    {
        $item = Item::find($id);
        return $item;
    }

    /**
     * @OA\put(
     *      path="/api/item",
     *      tags={"Items"},
     *      summary="Update Item",
     *      security={{"bearerAuth":{}}},
     *      description="Item düzenle",
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *            required={"id", "name", "description", "quantity"},
     *         @OA\Property(
     *              property="id",
     *              type="integer",
     *              format="integer",
     *              example="123"
     *              ),
     *            @OA\Property(
     *              property="name",
     *              type="string",
     *              format="string",
     *              example="name"
     *              ),
     *            @OA\Property(
     *              property="description",
     *              type="string",
     *              format="string",
     *              example="description"
     *              ),
     *            @OA\Property(
     *              property="quantity",
     *              type="integer",
     *              format="integer",
     *              example="123"
     *              ),
     *         ),
     *      ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                property="status",
     *                type="integer",
     *                 example=""
     *                 ),
     *             @OA\Property(
     *                property="data",
     *               type="object"
     *               )
     *          )
     *       )
     *  )
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function update(Request $request)
    {
        $item = Item::findOrFail($request->id);
        $item->name = $request->name;
        $item->description = $request->description;
        $item->quantity = $request->quantity;
        $item->save();
        return response()->json(['message' => 'Güncelleme işlemi başarılı']);
    }

    /**
     * @OA\Delete(
     *    path="/api/item/{id}",
     *    operationId="destroy",
     *    tags={"Items"},
     *    summary="Delete Items",
     *    security={{"bearerAuth":{}}},
     *    description="Item siler",
     *    @OA\Parameter(
     *          name="id",
     *          in="path",
     *          description="Id of Item",
     *          required=true,
     *        @OA\Schema(type="integer")
     *    ),
     *    @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *         @OA\Property(
     *            property="status_code",
     *            type="integer",
     *            example="200"
     *            ),
     *         @OA\Property(
     *             property="data",
     *             type="object"
     *           )
     *          ),
     *       )
     *      )
     *  )
     * @return JsonResponse
     */
    public function destroy(string $id)
    {
        $item = Item::destroy($id);
        return response()->json(['message' => 'Silme işlemi başarılı']);
    }
}
