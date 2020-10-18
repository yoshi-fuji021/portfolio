<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['comment','cozy_point','price_point','age_group_point','access_point','concentration_point','user_id','place_id'];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function place() { 
        return $this->belongsTo('App\Models\Place');
    }

    public function like()
    {
        return $this->hasMany('App\Models\Like');
}
