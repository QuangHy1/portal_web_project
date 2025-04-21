<?php
// app/Models/Editor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'full_name', 'date_of_birth', 'gender' ,'phone', 'address', 'bio', 'avatar', 'post_count',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


//    public function posts()
//    {
//        return $this->hasMany(Post::class, 'editor_id', 'user_id'); // lưu ý dùng user_id của Editor
//    }
//
//    public function guides()
//    {
//        return $this->hasMany(Guide::class, 'editor_id', 'user_id'); // tương tự
//    }

    public function post()
    {
        return $this->hasMany(Post::class, 'editor_id'); // 'editor_id' là foreign key trong bảng 'posts'
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
