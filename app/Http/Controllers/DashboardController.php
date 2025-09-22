<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userPreference = $user->userPreference;

        $userPreferenceArray = $userPreference->toArray();
        $destinations = Destination::active()->with('province')->get();

        $recommendedDestinations = $destinations->map(function ($destination) use ($userPreferenceArray) {
            $matchingResult = $destination->getMatchingScore($userPreferenceArray);
            $destination->matching_score = $matchingResult['total_score'];
            $destination->score_breakdown = $matchingResult['breakdown'];
            $destination->raw_score = $matchingResult['raw_score'];
            $destination->total_criteria = $matchingResult['total_criteria'];
            return $destination;
        })
            ->sortByDesc('matching_score')
            ->take(10);

        return Inertia::render('Dashboard', [
            'recommendedDestinations' => $recommendedDestinations
        ]);
    }
}
