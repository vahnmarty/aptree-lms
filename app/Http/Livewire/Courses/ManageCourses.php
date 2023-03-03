<?php

namespace App\Http\Livewire\Courses;

use Auth;
use App\Models\Course;
use Livewire\Component;
use App\Enums\CourseStatus;

class ManageCourses extends Component
{
    public $filter = 'published', $counts = [];

    public $courses = [];

    protected $queryString = ['filter'];

    public function render()
    {
        return view('livewire.courses.manage-courses');
    }

    public function mount()
    {
        $this->getCourses();

        $this->counts['published'] = Course::where('status', CourseStatus::Published)->count();
        $this->counts['draft'] = Course::where('status', CourseStatus::Draft)->count();
        $this->counts['deleted'] = Course::withTrashed()->whereNotNull('deleted_at')->count();
    }

    public function getCourses()
    {
        if($this->filter == 'published'){
            $this->courses = Course::where('status', CourseStatus::Published)->latest()->get();
        }
        elseif($this->filter == 'draft'){
            $this->courses = Course::where('status', CourseStatus::Draft)->latest()->get();
        }
        elseif($this->filter == 'deleted'){
            $this->courses = Course::withTrashed()->whereNotNull('deleted_at')->latest()->get();
        }
        else{
            $this->courses = Course::latest()->get();
        }
    }
}
