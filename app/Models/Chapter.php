<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapters';
    protected $guarded = [];

    public function comic()
    {
        return $this->belongsTo(Comic::class, 'comic_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function comment()
    {
        return $this->hasMany(Comment::class, 'chapter_id');
    }
}
