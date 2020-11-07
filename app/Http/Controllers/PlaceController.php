<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaceController extends Controller
{
    public function __construct(){
		$this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        // 登録されているレビューを全て取り出す。
        $places = Place::paginate(3);
        // View:place.indexを表示
        return view('place.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('place.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->action === 'back') //戻るボタンを押したときの処理
        { 
            return redirect()->route('place.index');
        }
        else 
        {
            // バリデーションの設定
            $validated = $request->validate([
                'name' => 'required',
                'address' => 'required',
                'category' => 'required',
                'description' => 'nullable'
            ],
            [
                'name.required' => '名前を入力してください。',
                'address.required' => '住所を入力してください。',
                'category.required' => '選択してください。',
                'description.nullable' => '入力してください。'
            ]);
            // 作成するユーザーIDを設定
            $validated['user_id'] = Auth::id();
            // レビューの保存
            $new = Place::create($validated);
            // 登録後はダッシュダッシュボードに遷移
            return redirect()->route('place.index')->with('message',$new->name.'のレビューを作成しました');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place = Place::find($id);
        return view('place.show', compact('place'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $place = Place::find($id);
        return view('place.edit', compact('place'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $place = Place::find($id);
        
        if($request->action === 'back') //戻るボタンを押した場合
        {
            return redirect()->route('place.index');
        } 
        elseif( $request->action === 'edit' && $place->user_id != Auth::id() ) //投稿者以外が編集しようとしたときの処理 
        {
            return back()->with('error',"このレビューは編集できません");
        }
        else // 更新処理
        {
            // バリデーションの設定
            $validated = $request->validate([
                'name' => 'required',
                'address' => 'required',
                'category' => 'required',
                'description' => 'nullable'
            ],
            [
                'name.required' => '名前を入力してください。',
                'address.required' => '住所を入力してください。',
                'category.required' => '選択してください。',
                'description.nullable' => '入力してください。'
            ]);
            // 値の更新
            $place->name = $validated['name'];
            $place->address = $validated['address'];
            $place->category = $validated['category'];
            $place->description = $validated['description'];
            $place->save();

            return redirect()->action([PlaceController::class, 'index'])->with('message','更新しました');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $places = Place::find($id);
        $places->delete();
        return redirect()->route('place.index');
    }
}
