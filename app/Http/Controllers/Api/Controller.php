<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="ATV API",
 *     version="1.0.0",
 *     description="API documentation for ATV application with authentication endpoints",
 *     @OA\Contact(
 *         email="admin@atv.com"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://127.0.0.1:8000",
 *     description="Development server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="sanctum",
 *     type="http",
 *     scheme="bearer",
 *     bearerFormat="JWT",
 *     description="Enter token in format: Bearer {token}"
 * )
 * 
 * @OA\Schema(
 *     schema="Atv",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Honda FourTrax 300"),
 *     @OA\Property(property="price", type="number", format="float", example=8500.00),
 *     @OA\Property(property="year", type="integer", example=2023),
 *     @OA\Property(property="clearance", type="string", example="8.5 inches"),
 *     @OA\Property(property="mileage", type="integer", example=1500),
 *     @OA\Property(property="transmission", type="string", example="Automatic"),
 *     @OA\Property(property="fuel", type="string", example="Gasoline"),
 *     @OA\Property(property="isActive", type="boolean", example=true),
 *     @OA\Property(property="isVip", type="boolean", example=false),
 *     @OA\Property(property="engine", type="string", example="286cc Single Cylinder"),
 *     @OA\Property(property="description", type="string", example="Excellent condition ATV with low mileage"),
 *     @OA\Property(property="location_id", type="integer", example=1),
 *     @OA\Property(property="location", ref="#/components/schemas/Location"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * 
 * @OA\Schema(
 *     schema="Location",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Tbilisi"),
 *     @OA\Property(property="country", type="string", example="Georgia"),
 *     @OA\Property(property="region", type="string", example="Tbilisi Region"),
 *     @OA\Property(property="type", type="string", enum={"city","region","country"}, example="city"),
 *     @OA\Property(property="is_georgian", type="boolean", example=true),
 *     @OA\Property(property="is_active", type="boolean", example=true),
 *     @OA\Property(property="latitude", type="number", format="float", example=41.7151),
 *     @OA\Property(property="longitude", type="number", format="float", example=44.8271),
 *     @OA\Property(property="full_name", type="string", example="Tbilisi, Georgia"),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 * 
 * @OA\Schema(
 *     schema="AtvImage",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="atv_id", type="integer", example=1),
 *     @OA\Property(property="url", type="string", example="https://example.com/image.jpg"),
 *     @OA\Property(property="type", type="string", enum={"image","video"}, example="image"),
 *     @OA\Property(property="alt_text", type="string", example="ATV front view"),
 *     @OA\Property(property="sort_order", type="integer", example=1),
 *     @OA\Property(property="is_primary", type="boolean", example=false),
 *     @OA\Property(property="is_active", type="boolean", example=true),
 *     @OA\Property(property="created_at", type="string", format="date-time"),
 *     @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 */
class Controller extends BaseController
{
    //
}
