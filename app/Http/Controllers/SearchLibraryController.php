<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchLibraryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        // 入力値
        $keyword_pref = $request->pref;
        $keyword_city = $request->city;

        // 外部APIアドレス
        $url = "http://api.calil.jp/library?appkey={d3e4ecba32bef60202bb5a9f4e6bd187}&pref=". $keyword_pref. "&city=". $keyword_city;
        $xml = simplexml_load_file($url);
        $xml_array = json_decode(json_encode($xml), true);
        foreach($xml_array as $key => $value) {
            // 連想配列だったら配列に変換
            if (is_array($value) && array_values($value) !== $value) {
                if (array_values($value) !== $value) {
                    $xml_array = array($key => array($value));
                }
            }
        }

        // 外部APIの出力(配列)
        $libraries = $xml_array["Library"];
        // 配列の総数
        $count = count($xml_array["Library"]);
        // 1ページに表示する数
        $limit = 10;
        // 最終ページの掲載開始番目を求めます。
        $lastpage = floor($count / $limit) * $limit;
        // 2ページ目以降の1点目の表示を調整するための変数
        $listpage = (($request->page) - 1) * $limit;

        if ($request->page == null||$request->page == 1) {
            // ペジネーション
            $paginator = new LengthAwarePaginator(
                array_slice($libraries, 0, $limit, false),
                $count,
                $limit,
                $request->page,
                array('path' => $request->url())
            );
        } elseif ($request->page == round($lastpage)) {
            //最終ページの場合
            $paginator = new LengthAwarePaginator (
                array_slice($libraries, round($lastpage), $limit, false),
                $count,
                $limit,
                $request->page,
                array('path' => $request->url())
            );
        } else {
            $paginator = new LengthAwarePaginator (
                array_slice($libraries, round($listpage), $limit, false),
                $count,
                $limit,
                $request->page,
                array('path' => $request->url())
            );
        }
        // ペジネーションの内部の配列を取得
        $items = $paginator->all();
        
        if($count > 0) 
		{
            $message = $keyword_pref.$keyword_city."の検索結果です。";
            return view('library.search', compact('items','paginator','message'));
        }
        else 
        {
            $message = "検索結果はありません。";
			return view('library.search',compact('message'));
        }
    }
}
