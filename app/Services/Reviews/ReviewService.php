<?php

namespace App\Services\Reviews;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class ReviewService
{
    /**
     * Get all reviews for a specific product.
     */
    public function getProductReviews(Product $product): Collection
    {
        return $product->reviews()->with('user')->latest()->get();
    }

    /**
     * Check if a user has already reviewed a product.
     */
    public function hasUserReviewedProduct(User $user, Product $product): bool
    {
        return $product->reviews()->where('user_id', $user->id)->exists();
    }

    /**
     * Create a review for a product.
     */
    public function createReview(User $user, Product $product, array $data): Review
    {
        return $product->reviews()->create([
            'user_id' => $user->id,
            'rating' => $data['rating'],
            'comment' => $data['comment'] ?? null,
        ]);
    }
}
