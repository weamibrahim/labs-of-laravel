<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
   
    use HasFactory;
    use Sluggable;
      protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'user_id',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function user(){
return $this->belongsTo(related: User::class);


    }
    
    public function comments(){

        return $this->morphMany(Comment::class,'commentable');
    }

    
}
