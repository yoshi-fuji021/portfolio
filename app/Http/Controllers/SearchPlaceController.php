<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;

class SearchPlaceController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
			$keyword_name = $request->name;

			if(!empty($keyword_name)) {
				$places = Place::where('name','like', '%' .$keyword_name. '%')->get();
				$message = "「". $keyword_name."」を含む名前の検索が完了しました。";
				return view('place.search',compact('places','message'));
			}
			else {
				$message = "検索結果はありません。";
				return view('place.search',compact('message'));
			}
    }
}
