<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'maker_id'
    ];

    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }

    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }
}
