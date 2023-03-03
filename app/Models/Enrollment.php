<?php

namespace App\Models;

use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelTraits\TraitHasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;
    use TraitHasUuid;

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function items()
    {
        return $this->belongsToMany(ModuleItem::class, 'enrollment_module_items');
    }

    public function enrollmentModules()
    {
        return $this->hasMany(EnrollmentModule::class);
    }

    public function isComplete()
    {
        return $this->completed_at ? true : false;
    }
}
