<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class Maker extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'number_of_people',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()   
    {
        return $this->hasMany(Member::class);  
    }

    public function groups()   
    {
        return $this->hasMany(Group::class);  
    }

    public function getByPagination($limit = 10)
    {
        return $this::with('groups')->orderBy('created_at', 'DESC')->paginate($limit);
    }
}
