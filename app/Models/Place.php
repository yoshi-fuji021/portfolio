<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Place extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name','address','category','description','user_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function review() { 
        return $this->hasMany('App\Models\Review');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    /**
    * リプライにLIKEを付いているかの判定
    *
    * @return bool true:Likeがついてる false:Likeがついてない
    */
    public function is_liked_by_auth_user()
    {
        $id = Auth::id();
        $likers = array();

        foreach ($this->likes as $like) 
        {
            array_push($likers, $like->user_id);
        }

        if (in_array($id, $likers)) 
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
}
