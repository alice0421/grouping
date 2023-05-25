<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function maker()
    {
        return $this->belongsTo(Maker::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class);
    }
}
