<?php

namespace App\Http\Controllers\Api\V1\Rewards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Customer\RedeemRewardRequest;

class RewardController extends Controller
{
    public function getPoints(Request $request)
    {
        return response()->json([
            'status' => 'success',
            'points' => (int) $request->user()->reward_points
        ]);
    }

    public function redeem(RedeemRewardRequest $request)
    {
        $validated = $request->validated();

        $user = $request->user();
        $pointsToRedeem = $validated['points'];

        if ($user->reward_points < $pointsToRedeem) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient points.'
            ], 400);
        }

        $user->reward_points -= $pointsToRedeem;
        $user->save();

        return response()->json([
            'status' => 'success',
            'message' => "Successfully redeemed {$pointsToRedeem} points! Enjoy your reward.",
            'points' => (int) $user->reward_points
        ]);
    }
}
