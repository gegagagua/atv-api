<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\AtvImageRequest;
use App\Models\Atv;
use App\Models\AtvImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class AtvImageController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/atvs/{atv_id}/images",
     *     summary="Get all images for a specific ATV",
     *     tags={"ATV Images"},
     *     @OA\Parameter(
     *         name="atv_id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filter by type (image, video)",
     *         required=false,
     *         @OA\Schema(type="string", example="image")
     *     ),
     *     @OA\Parameter(
     *         name="active_only",
     *         in="query",
     *         description="Show only active images",
     *         required=false,
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ATV images retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/AtvImage"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ATV not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="ATV not found")
     *         )
     *     )
     * )
     */
    public function index(Request $request, $atvId): JsonResponse
    {
        $atv = Atv::findOrFail($atvId);
        
        $query = $atv->images();

        if ($request->filled('type')) {
            if ($request->type === 'image') {
                $query->images();
            } elseif ($request->type === 'video') {
                $query->videos();
            }
        }

        if ($request->boolean('active_only')) {
            $query->active();
        }

        $images = $query->ordered()->get();

        return response()->json([
            'status' => 'success',
            'data' => $images,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/atvs/{atv_id}/images",
     *     summary="Add an image/video to ATV gallery",
     *     tags={"ATV Images"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="atv_id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"url","type"},
     *             @OA\Property(property="url", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="type", type="string", enum={"image","video"}, example="image"),
     *             @OA\Property(property="alt_text", type="string", example="ATV front view"),
     *             @OA\Property(property="sort_order", type="integer", example=1),
     *             @OA\Property(property="is_primary", type="boolean", example=false),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Image added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Image added successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/AtvImage")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ATV not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="ATV not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(AtvImageRequest $request, $atvId): JsonResponse
    {
        $atv = Atv::findOrFail($atvId);
        
        $data = $request->validated();
        $data['atv_id'] = $atvId;
        
        if ($data['is_primary'] ?? false) {
            AtvImage::where('atv_id', $atvId)->update(['is_primary' => false]);
        }
        
        $image = AtvImage::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Image added successfully',
            'data' => $image,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/atvs/{atv_id}/images/{id}",
     *     summary="Get a specific ATV image",
     *     tags={"ATV Images"},
     *     @OA\Parameter(
     *         name="atv_id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Image ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ATV image retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", ref="#/components/schemas/AtvImage")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ATV or image not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="ATV or image not found")
     *         )
     *     )
     * )
     */
    public function show($atvId, $id): JsonResponse
    {
        $atv = Atv::findOrFail($atvId);
        $image = $atv->images()->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'data' => $image,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/atvs/{atv_id}/images/{id}",
     *     summary="Update an ATV image",
     *     tags={"ATV Images"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="atv_id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Image ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="url", type="string", format="url", example="https://example.com/image.jpg"),
     *             @OA\Property(property="type", type="string", enum={"image","video"}, example="image"),
     *             @OA\Property(property="alt_text", type="string", example="ATV front view"),
     *             @OA\Property(property="sort_order", type="integer", example=1),
     *             @OA\Property(property="is_primary", type="boolean", example=false),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Image updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Image updated successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/AtvImage")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ATV or image not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="ATV or image not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function update(AtvImageRequest $request, $atvId, $id): JsonResponse
    {
        $atv = Atv::findOrFail($atvId);
        $image = $atv->images()->findOrFail($id);
        
        $data = $request->validated();
        
        if ($data['is_primary'] ?? false) {
            AtvImage::where('atv_id', $atvId)->where('id', '!=', $id)->update(['is_primary' => false]);
        }
        
        $image->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Image updated successfully',
            'data' => $image,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/atvs/{atv_id}/images/{id}",
     *     summary="Delete an ATV image",
     *     tags={"ATV Images"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="atv_id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Image ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Image deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Image deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ATV or image not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="ATV or image not found")
     *         )
     *     )
     * )
     */
    public function destroy($atvId, $id): JsonResponse
    {
        $atv = Atv::findOrFail($atvId);
        $image = $atv->images()->findOrFail($id);
        
        $image->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Image deleted successfully',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/atvs/{atv_id}/images/{id}/set-primary",
     *     summary="Set an image as primary for ATV",
     *     tags={"ATV Images"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="atv_id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Image ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Primary image set successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Primary image set successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ATV or image not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="ATV or image not found")
     *         )
     *     )
     * )
     */
    public function setPrimary($atvId, $id): JsonResponse
    {
        $atv = Atv::findOrFail($atvId);
        $image = $atv->images()->findOrFail($id);
        
        AtvImage::where('atv_id', $atvId)->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return response()->json([
            'status' => 'success',
            'message' => 'Primary image set successfully',
        ]);
    }
}