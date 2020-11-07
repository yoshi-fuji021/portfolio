<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchLibraryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        $keyword_pref = $request->pref;
        $keyword_city = $request->city;

        if(!empty($keyword_pref)) 
		{
            $url = "http://api.calil.jp/library?appkey={d3e4ecba32bef60202bb5a9f4e6bd187}&pref=". $keyword_pref. "&city=". $keyword_city;
            $xml = simplexml_load_file($url);
            
            $libraries = $xml->Library;
        
            return view('library.search',compact('libraries'));
        }
        else 
        {
            $message = "検索結果はありません。";
			return view('library.search',compact('message'));
        }
    }
}
