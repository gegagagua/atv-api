<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\LocationRequest;
use App\Models\Location;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class LocationController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/locations",
     *     summary="Get all locations with filtering options",
     *     tags={"Locations"},
     *     @OA\Parameter(
     *         name="georgian_only",
     *         in="query",
     *         description="Show only Georgian locations",
     *         required=false,
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Parameter(
     *         name="international_only",
     *         in="query",
     *         description="Show only international locations",
     *         required=false,
     *         @OA\Schema(type="boolean", example=false)
     *     ),
     *     @OA\Parameter(
     *         name="active_only",
     *         in="query",
     *         description="Show only active locations",
     *         required=false,
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Parameter(
     *         name="country",
     *         in="query",
     *         description="Filter by country",
     *         required=false,
     *         @OA\Schema(type="string", example="Georgia")
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filter by type (city, region, country)",
     *         required=false,
     *         @OA\Schema(type="string", example="city")
     *     ),
     *     @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="Search locations by name, country, or region",
     *         required=false,
     *         @OA\Schema(type="string", example="Tbilisi")
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         description="Number of items per page",
     *         required=false,
     *         @OA\Schema(type="integer", example=15)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Locations retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Location")),
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
        $query = Location::query();

        // Apply filters
        if ($request->boolean('georgian_only')) {
            $query->georgian();
        }

        if ($request->boolean('international_only')) {
            $query->international();
        }

        if ($request->boolean('active_only')) {
            $query->active();
        }

        if ($request->filled('country')) {
            $query->byCountry($request->country);
        }

        if ($request->filled('type')) {
            $query->byType($request->type);
        }

        // Add search functionality
        if ($request->filled('search')) {
            $query->search($request->get('search'));
        }

        $perPage = $request->get('per_page', 15);
        $locations = $query->orderBy('country')->orderBy('name')->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $locations,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/locations",
     *     summary="Create a new location",
     *     tags={"Locations"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","country","type"},
     *             @OA\Property(property="name", type="string", example="Tbilisi"),
     *             @OA\Property(property="country", type="string", example="Georgia"),
     *             @OA\Property(property="region", type="string", example="Tbilisi Region"),
     *             @OA\Property(property="type", type="string", enum={"city","region","country"}, example="city"),
     *             @OA\Property(property="is_georgian", type="boolean", example=true),
     *             @OA\Property(property="is_active", type="boolean", example=true),
     *             @OA\Property(property="latitude", type="number", format="float", example=41.7151),
     *             @OA\Property(property="longitude", type="number", format="float", example=44.8271)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Location created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Location created successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Location")
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
    public function store(LocationRequest $request): JsonResponse
    {
        $location = Location::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Location created successfully',
            'data' => $location,
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/locations/{location}",
     *     summary="Get a specific location",
     *     tags={"Locations"},
     *     @OA\Parameter(
     *         name="location",
     *         in="path",
     *         description="Location ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", ref="#/components/schemas/Location")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Location] 999")
     *         )
     *     )
     * )
     */
    public function show(Location $location): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $location,
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/locations/{location}",
     *     summary="Update a location",
     *     tags={"Locations"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="location",
     *         in="path",
     *         description="Location ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Tbilisi"),
     *             @OA\Property(property="country", type="string", example="Georgia"),
     *             @OA\Property(property="region", type="string", example="Tbilisi Region"),
     *             @OA\Property(property="type", type="string", enum={"city","region","country"}, example="city"),
     *             @OA\Property(property="is_georgian", type="boolean", example=true),
     *             @OA\Property(property="is_active", type="boolean", example=true),
     *             @OA\Property(property="latitude", type="number", format="float", example=41.7151),
     *             @OA\Property(property="longitude", type="number", format="float", example=44.8271)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Location updated successfully"),
     *             @OA\Property(property="data", ref="#/components/schemas/Location")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Location] 999")
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
    public function update(LocationRequest $request, Location $location): JsonResponse
    {
        $location->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Location updated successfully',
            'data' => $location,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/locations/{location}",
     *     summary="Delete a location",
     *     tags={"Locations"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="location",
     *         in="path",
     *         description="Location ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Location deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Location deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Location not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="No query results for model [App\\Models\\Location] 999")
     *         )
     *     )
     * )
     */
    public function destroy(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Location deleted successfully',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/locations/georgian/cities",
     *     summary="Get all Georgian cities",
     *     tags={"Locations"},
     *     @OA\Response(
     *         response=200,
     *         description="Georgian cities retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Location"))
     *         )
     *     )
     * )
     */
    public function georgianCities(): JsonResponse
    {
        $cities = Location::georgian()
            ->byType('city')
            ->active()
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $cities,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/locations/countries",
     *     summary="Get all countries",
     *     tags={"Locations"},
     *     @OA\Response(
     *         response=200,
     *         description="Countries retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Location"))
     *         )
     *     )
     * )
     */
    public function countries(): JsonResponse
    {
        $countries = Location::byType('country')
            ->active()
            ->orderBy('name')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $countries,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/locations/search",
     *     summary="Search locations by name, country, or region",
     *     tags={"Locations"},
     *     @OA\Parameter(
     *         name="q",
     *         in="query",
     *         description="Search query",
     *         required=true,
     *         @OA\Schema(type="string", example="Tbilisi")
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="Filter by type (city, region, country)",
     *         required=false,
     *         @OA\Schema(type="string", example="city")
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Limit number of results",
     *         required=false,
     *         @OA\Schema(type="integer", example=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Search results retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Location"))
     *         )
     *     )
     * )
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $type = $request->get('type');
        $limit = $request->get('limit', 10);

        if (empty($query)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search query is required',
            ], 400);
        }

        $locations = Location::query()
            ->search($query)
            ->when($type, function ($q) use ($type) {
                return $q->byType($type);
            })
            ->active()
            ->orderBy('name')
            ->limit($limit)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $locations,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/locations/popular",
     *     summary="Get popular locations for selection",
     *     tags={"Locations"},
     *     @OA\Parameter(
     *         name="georgian_only",
     *         in="query",
     *         description="Show only Georgian locations",
     *         required=false,
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Parameter(
     *         name="limit",
     *         in="query",
     *         description="Limit number of results",
     *         required=false,
     *         @OA\Schema(type="integer", example=20)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Popular locations retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Location"))
     *         )
     *     )
     * )
     */
    public function popular(Request $request): JsonResponse
    {
        $georgianOnly = $request->boolean('georgian_only', false);
        $limit = $request->get('limit', 20);

        $query = Location::query()
            ->popular();

        if ($georgianOnly) {
            $query->georgian();
        }

        $locations = $query
            ->orderBy('name')
            ->limit($limit)
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $locations,
        ]);
    }
}