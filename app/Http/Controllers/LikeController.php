<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['like', 'unlike']);
    }

    /**
     * 引数のIDに紐づくリプライにLIKEする
     *
     * @param $id リプライID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function like($id)
    {
        Like::create([
        'place_id' => $id,
        'user_id' => Auth::id(),
        ]);

        return redirect()->back();
    }

    /**
     * 引数のIDに紐づくリプライにUNLIKEする
     *
     * @param $id リプライID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unlike($id)
    {
        $like = Like::where('place_id', $id)->where('user_id', Auth::id())->first();
        $like->delete();

        return redirect()->back();
    }
}
