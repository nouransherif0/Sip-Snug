<?php

namespace App\Http\Controllers\Api\V1\Reviews;

use App\Http\Controllers\Controller;
use App\Http\Requests\Reviews\StoreReviewRequest;
use App\Http\Resources\Reviews\ReviewResource;
use App\Models\Product;
use App\Services\Reviews\ReviewService;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    protected ReviewService $reviewService;

    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    /**
     * Display a listing of reviews for the product.
     */
    public function index(Product $product): JsonResponse
    {
        $reviews = $this->reviewService->getProductReviews($product);

        return response()->json([
            'status' => 'success',
            'data' => ReviewResource::collection($reviews),
        ]);
    }

    /**
     * Store a newly created review in storage.
     */
    public function store(StoreReviewRequest $request, Product $product): JsonResponse
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        // Check if user already reviewed this product
        if ($this->reviewService->hasUserReviewedProduct($user, $product)) {
            return response()->json(['message' => 'You have already reviewed this product.'], 400);
        }

        $review = $this->reviewService->createReview($user, $product, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Review submitted successfully.',
            'data' => new ReviewResource($review),
        ], 201);
    }
}
