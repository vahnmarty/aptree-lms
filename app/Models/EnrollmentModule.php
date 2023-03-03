<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ModelTraits\TraitHasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EnrollmentModule extends Model
{
    use HasFactory;
    use TraitHasUuid;

    protected $guarded = [];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }

    public function items()
    {
        return $this->hasMany(EnrollmentModuleItem::class);
    }
}
