<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\AtvRequest;
use App\Models\Atv;
use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

class AtvController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/atvs",
     *     summary="Get all ATVs",
     *     tags={"ATVs"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Page number",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Items per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=15)
     *     ),
     *     @OA\Parameter(
     *         name="active_only",
     *         in="query",
     *         description="Show only active ATVs",
     *         required=false,
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Parameter(
     *         name="vip_only",
     *         in="query",
     *         description="Show only VIP ATVs",
     *         required=false,
     *         @OA\Schema(type="boolean", example=false)
     *     ),
     *     @OA\Parameter(
     *         name="location_id",
     *         in="query",
     *         description="Filter by location ID",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Parameter(
     *         name="location_name",
     *         in="query",
     *         description="Filter by location name (partial match)",
     *         required=false,
     *         @OA\Schema(type="string", example="Tbilisi")
     *     ),
     *     @OA\Parameter(
     *         name="year_from",
     *         in="query",
     *         description="Filter by minimum year",
     *         required=false,
     *         @OA\Schema(type="integer", example=2020)
     *     ),
     *     @OA\Parameter(
     *         name="year_to",
     *         in="query",
     *         description="Filter by maximum year",
     *         required=false,
     *         @OA\Schema(type="integer", example=2024)
     *     ),
     *     @OA\Parameter(
     *         name="price_from",
     *         in="query",
     *         description="Filter by minimum price",
     *         required=false,
     *         @OA\Schema(type="number", format="float", example=5000)
     *     ),
     *     @OA\Parameter(
     *         name="price_to",
     *         in="query",
     *         description="Filter by maximum price",
     *         required=false,
     *         @OA\Schema(type="number", format="float", example=15000)
     *     ),
     *     @OA\Parameter(
     *         name="mileage_from",
     *         in="query",
     *         description="Filter by minimum mileage",
     *         required=false,
     *         @OA\Schema(type="integer", example=0)
     *     ),
     *     @OA\Parameter(
     *         name="mileage_to",
     *         in="query",
     *         description="Filter by maximum mileage",
     *         required=false,
     *         @OA\Schema(type="integer", example=10000)
     *     ),
     *     @OA\Parameter(
     *         name="engine_from",
     *         in="query",
     *         description="Filter by minimum engine size (cc)",
     *         required=false,
     *         @OA\Schema(type="integer", example=250)
     *     ),
     *     @OA\Parameter(
     *         name="engine_to",
     *         in="query",
     *         description="Filter by maximum engine size (cc)",
     *         required=false,
     *         @OA\Schema(type="integer", example=500)
     *     ),
     *     @OA\Parameter(
     *         name="fuel",
     *         in="query",
     *         description="Filter by fuel type",
     *         required=false,
     *         @OA\Schema(type="string", example="Gasoline")
     *     ),
     *     @OA\Parameter(
     *         name="transmission",
     *         in="query",
     *         description="Filter by transmission type",
     *         required=false,
     *         @OA\Schema(type="string", example="Automatic")
     *     ),
     *     @OA\Parameter(
     *         name="brand_id",
     *         in="query",
     *         description="Filter by brand ID",
     *         required=false,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ATVs retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Atv")),
     *                 @OA\Property(property="current_page", type="integer", example=1),
     *                 @OA\Property(property="per_page", type="integer", example=15),
     *                 @OA\Property(property="total", type="integer", example=25)
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        $query = Atv::query();

        // Apply filters
        if ($request->boolean('active_only')) {
            $query->active();
        }

        if ($request->boolean('vip_only')) {
            $query->vip();
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        if ($request->filled('location_name')) {
            $query->whereHas('location', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->location_name . '%');
            });
        }

        // Year range filter
        if ($request->filled('year_from')) {
            $query->where('year', '>=', $request->year_from);
        }
        if ($request->filled('year_to')) {
            $query->where('year', '<=', $request->year_to);
        }

        // Price range filter
        if ($request->filled('price_from')) {
            $query->where('price', '>=', $request->price_from);
        }
        if ($request->filled('price_to')) {
            $query->where('price', '<=', $request->price_to);
        }

        // Mileage range filter
        if ($request->filled('mileage_from')) {
            $query->where('mileage', '>=', $request->mileage_from);
        }
        if ($request->filled('mileage_to')) {
            $query->where('mileage', '<=', $request->mileage_to);
        }

        // Engine range filter (assuming engine field contains numeric values)
        if ($request->filled('engine_from')) {
            $query->whereRaw('CAST(SUBSTRING_INDEX(engine, "cc", 1) AS UNSIGNED) >= ?', [$request->engine_from]);
        }
        if ($request->filled('engine_to')) {
            $query->whereRaw('CAST(SUBSTRING_INDEX(engine, "cc", 1) AS UNSIGNED) <= ?', [$request->engine_to]);
        }

        // Fuel filter
        if ($request->filled('fuel')) {
            $query->where('fuel', $request->fuel);
        }

        // Transmission filter
        if ($request->filled('transmission')) {
            $query->where('transmission', $request->transmission);
        }

        // Brand filter
        if ($request->filled('brand_id')) {
            $query->where('brand_id', $request->brand_id);
        }

        // Name/Model filter
        if ($request->filled('name')) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        // Sorting
        $sortBy = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');
        
        // Validate sort column to prevent SQL injection
        $allowedSorts = ['created_at', 'price', 'year', 'mileage', 'name'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder);
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $perPage = $request->get('per_page', 15);
        $atvs = $query->with(['location', 'user', 'brand', 'activeImages'])->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $atvs,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/atvs",
     *     summary="Create a new ATV",
     *     tags={"ATVs"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","price","year","clearance","mileage","transmission","fuel","engine","brand_id"},
     *             @OA\Property(property="name", type="string", example="Honda FourTrax 300"),
     *             @OA\Property(property="price", type="number", format="float", example=8500.00),
     *             @OA\Property(property="year", type="integer", example=2023),
     *             @OA\Property(property="clearance", type="string", example="8.5 inches"),
     *             @OA\Property(property="mileage", type="integer", example=1500),
     *             @OA\Property(property="transmission", type="string", example="Automatic"),
     *             @OA\Property(property="fuel", type="string", example="Gasoline"),
     *             @OA\Property(property="isActive", type="boolean", example=true),
             *             @OA\Property(property="isVip", type="boolean", example=false),
     *             @OA\Property(property="engine", type="string", example="286cc Single Cylinder"),
     *             @OA\Property(property="description", type="string", example="Excellent condition ATV with low mileage"),
     *             @OA\Property(property="location_id", type="integer", example=1),
     *             @OA\Property(property="brand_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="ATV created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="ATV created successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Atv")
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
    public function store(AtvRequest $request): JsonResponse
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        
        $atv = Atv::create($data);
        $atv->load(['location', 'user', 'brand', 'activeImages']);

        return response()->json([
            'status' => 'success',
            'message' => 'ATV created successfully',
            'data' => $atv,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/atvs/{id}",
     *     summary="Get a specific ATV",
     *     tags={"ATVs"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ATV retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", ref="#/components/schemas/Atv")
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
    public function show(Atv $atv): JsonResponse
    {
        $atv->load(['location', 'user', 'brand', 'activeImages']);
        
        return response()->json([
            'status' => 'success',
            'data' => $atv,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/atvs/{id}",
     *     summary="Update an ATV",
     *     tags={"ATVs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","price","year","clearance","mileage","transmission","fuel","engine","brand_id"},
     *             @OA\Property(property="name", type="string", example="Honda FourTrax 300"),
     *             @OA\Property(property="price", type="number", format="float", example=8500.00),
     *             @OA\Property(property="year", type="integer", example=2023),
     *             @OA\Property(property="clearance", type="string", example="8.5 inches"),
     *             @OA\Property(property="mileage", type="integer", example=1500),
     *             @OA\Property(property="transmission", type="string", example="Automatic"),
     *             @OA\Property(property="fuel", type="string", example="Gasoline"),
     *             @OA\Property(property="isActive", type="boolean", example=true),
             *             @OA\Property(property="isVip", type="boolean", example=false),
     *             @OA\Property(property="engine", type="string", example="286cc Single Cylinder"),
     *             @OA\Property(property="description", type="string", example="Excellent condition ATV with low mileage"),
     *             @OA\Property(property="location_id", type="integer", example=1),
     *             @OA\Property(property="brand_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ATV updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="ATV updated successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Atv")
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
    public function update(AtvRequest $request, Atv $atv): JsonResponse
    {
        // Check if user owns this ATV or is admin
        if ($atv->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You can only update your own ATVs.',
            ], 403);
        }

        $atv->update($request->validated());
        $atv->load(['location', 'user', 'brand', 'activeImages']);

        return response()->json([
            'status' => 'success',
            'message' => 'ATV updated successfully',
            'data' => $atv,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/atvs/{id}",
     *     summary="Delete an ATV",
     *     tags={"ATVs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ATV deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="ATV deleted successfully")
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
    public function destroy(Atv $atv): JsonResponse
    {
        // Check if user owns this ATV or is admin
        if ($atv->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized. You can only delete your own ATVs.',
            ], 403);
        }

        $atv->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'ATV deleted successfully',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/atvs/{id}/images",
     *     summary="Get all images for a specific ATV",
     *     tags={"ATVs"},
     *     @OA\Parameter(
     *         name="id",
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
    public function images(Request $request, Atv $atv): JsonResponse
    {
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
     * @OA\Get(
     *     path="/api/atvs/{id}/gallery",
     *     summary="Get ATV gallery with formatted data",
     *     tags={"ATVs"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="ATV gallery retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="url", type="string", example="https://example.com/image.jpg"),
     *                 @OA\Property(property="type", type="string", example="image"),
     *                 @OA\Property(property="alt_text", type="string", example="ATV front view"),
     *                 @OA\Property(property="sort_order", type="integer", example=1),
     *                 @OA\Property(property="is_primary", type="boolean", example=true),
     *                 @OA\Property(property="is_active", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time")
     *             ))
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
    public function gallery(Atv $atv): JsonResponse
    {
        $gallery = $atv->gallery;

        return response()->json([
            'status' => 'success',
            'data' => $gallery,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/atvs/{id}/primary-image",
     *     summary="Get ATV primary image",
     *     tags={"ATVs"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ATV ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Primary image retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", ref="#/components/schemas/AtvImage")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="ATV or primary image not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Primary image not found")
     *         )
     *     )
     * )
     */
    public function primaryImage(Atv $atv): JsonResponse
    {
        $primaryImage = $atv->primaryImage()->first();

        if (!$primaryImage) {
            return response()->json([
                'status' => 'error',
                'message' => 'Primary image not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => $primaryImage,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/brands",
     *     summary="Get all ATV brands",
     *     description="Retrieve a list of all available ATV brands",
     *     tags={"Brands"},
     *     @OA\Response(
     *         response=200,
     *         description="Brands retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="array", @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Honda"),
     *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-19T18:35:16.000000Z"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-19T18:35:16.000000Z")
     *             ))
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */
    public function brands(): JsonResponse
    {
        $brands = Brand::orderBy('title')->get();

        return response()->json([
            'status' => 'success',
            'data' => $brands,
        ]);
    }
}