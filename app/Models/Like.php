<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id','review_id','place_id'];
    
    public function user() {
        return $this->belongsTo('App\Models\User');
    }
    
    public function review() {
        return $this->belongsTo('App\Models\Review');
    }

    public function place() {
        return $this->belongsTo('App\Models\Place');
    }
}
