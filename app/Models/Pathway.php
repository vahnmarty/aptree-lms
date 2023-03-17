<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pathway extends Model
{
    use HasFactory;
    use HasTags;

    public function goal()
    {
        return $this->belongsTo(Goal::class);
    }
}
