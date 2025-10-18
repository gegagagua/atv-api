<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class BlogController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/blogs",
     *     summary="Get all blogs",
     *     description="Retrieve a paginated list of all blogs",
     *     tags={"Blogs"},
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
     *         description="Show only active blogs",
     *         required=false,
     *         @OA\Schema(type="boolean", example=true)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blogs retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="data", type="array", @OA\Items(
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="title", type="string", example="Sample Blog Post"),
     *                     @OA\Property(property="description", type="string", example="This is a sample blog post description"),
     *                     @OA\Property(property="image", type="string", example="https://example.com/image.jpg"),
     *                     @OA\Property(property="is_active", type="boolean", example=true),
     *                     @OA\Property(property="created_at", type="string", format="date-time"),
     *                     @OA\Property(property="updated_at", type="string", format="date-time")
     *                 )),
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
        $query = Blog::query();

        // Active only filter
        if ($request->boolean('active_only', true)) {
            $query->active();
        }

        $perPage = $request->get('per_page', 15);
        $blogs = $query->orderBy('created_at', 'desc')->paginate($perPage);

        return response()->json([
            'status' => 'success',
            'data' => $blogs,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/blogs/{id}",
     *     summary="Get a specific blog",
     *     description="Retrieve a single blog by its ID",
     *     tags={"Blogs"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Blog ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blog retrieved successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Sample Blog Post"),
     *                 @OA\Property(property="description", type="string", example="This is a sample blog post description"),
     *                 @OA\Property(property="image", type="string", example="https://example.com/image.jpg"),
     *                 @OA\Property(property="is_active", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Blog not found")
     *         )
     *     )
     * )
     */
    public function show(Blog $blog): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $blog,
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/blogs",
     *     summary="Create a new blog",
     *     description="Create a new blog post",
     *     tags={"Blogs"},
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title","description"},
     *             @OA\Property(property="title", type="string", example="New Blog Post"),
     *             @OA\Property(property="description", type="text", example="This is the content of the blog post"),
     *             @OA\Property(property="image", type="string", example="https://example.com/image.jpg"),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Blog created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Blog created successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="New Blog Post"),
     *                 @OA\Property(property="description", type="string", example="This is the content of the blog post"),
     *                 @OA\Property(property="image", type="string", example="https://example.com/image.jpg"),
     *                 @OA\Property(property="is_active", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function store(BlogRequest $request): JsonResponse
    {
        $blog = Blog::create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Blog created successfully',
            'data' => $blog,
        ], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/blogs/{id}",
     *     summary="Update a blog",
     *     description="Update an existing blog post",
     *     tags={"Blogs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Blog ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="title", type="string", example="Updated Blog Post"),
     *             @OA\Property(property="description", type="text", example="This is the updated content of the blog post"),
     *             @OA\Property(property="image", type="string", example="https://example.com/updated-image.jpg"),
     *             @OA\Property(property="is_active", type="boolean", example=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blog updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Blog updated successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Updated Blog Post"),
     *                 @OA\Property(property="description", type="string", example="This is the updated content of the blog post"),
     *                 @OA\Property(property="image", type="string", example="https://example.com/updated-image.jpg"),
     *                 @OA\Property(property="is_active", type="boolean", example=true),
     *                 @OA\Property(property="created_at", type="string", format="date-time"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Blog not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function update(BlogRequest $request, Blog $blog): JsonResponse
    {
        $blog->update($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Blog updated successfully',
            'data' => $blog,
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/blogs/{id}",
     *     summary="Delete a blog",
     *     description="Delete an existing blog post",
     *     tags={"Blogs"},
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Blog ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Blog deleted successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Blog deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Blog not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="error"),
     *             @OA\Property(property="message", type="string", example="Blog not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Unauthenticated.")
     *         )
     *     )
     * )
     */
    public function destroy(Blog $blog): JsonResponse
    {
        $blog->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Blog deleted successfully',
        ]);
    }
}