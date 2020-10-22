<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

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

    public function like()
    {
        return $this->hasMany('App\Models\Like');
    }
}
