<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;

    protected $table = 'comics';
    protected $guarded = [];

    public function chapter()
    {
        return $this->hasMany(Chapter::class, 'comic_id', 'id');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class, 'comic_id');
    }

    public function genre()
    {
        return $this->belongsToMany(Genre::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
