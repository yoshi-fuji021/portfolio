<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Place;

class PlaceReviewController extends Controller
{
    public function list() {
        return Place::with('reviews.user')->get();
    }

    public function review(Request $request) {

        $result = false;

        // バリデーション
        $request->validate([
            'place_id' => [
                'required',
                'exists:places,id',
                function($attribute, $value, $fail) use($request) 
                {
                    // ログインしてるかチェック
                    if(!auth()->check()) {
                        $fail('ログインしてください。');
                        return;
                    }

                    // すでにレビュー投稿してるかチェック
                    $exists = Review::where('user_id', $request->user()->id)
                    ->where('place_id', $request->place_id)
                    ->exists();

                    if($exists) {
                        $fail('すでにレビューは投稿済みです。');
                        return;
                    }

                }
            ],
            'comment' => 'nullable',
            'cozy_point' => 'required|integer|min:1|max:5',
            'price_point' => 'required|integer|min:1|max:5',
            'age_group_point' => 'required|integer|min:1|max:5',
            'access_point' => 'required|integer|min:1|max:5',
            'concentration_point' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->place_id = $request->place_id;
        $review->user_id = $request->user()->id;
        $review->cozy_point = $request->cozy_point;
        $review->price_point = $request->price_point;
        $review->age_group_point = $request->age_group_point;
        $review->access_point = $request->access_point;
        $review->concentration_point = $request->concentration_point;
        $review->comment = $request->comment;
        $review_results = $review->save();
        return view('place.index', compact('review_results'));
    }
}
