<?php

namespace App\Http\Livewire\Courses;

use Str;
use App\Models\Tag;
use App\Models\User;
use App\Models\Course;
use App\Models\Tenant;
use Livewire\Component;
use App\Enums\CourseStatus;
use App\Models\CourseCategory;
use Filament\Forms\Components\Grid;
use App\Forms\Components\SelectIcon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use App\Forms\Components\SimpleFieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class EditCourse extends Component implements HasForms
{
    use InteractsWithForms;
    
    public Course $course;
    public $course_id;

    public function render()
    {
        return view('livewire.tenant.courses.edit-course');
    }

    public function mount($id)
    {
        $this->course = Course::findOrFail($id);
        $this->course_id = $id;

        $this->form->fill($this->course->toArray());
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(5)
                ->schema([
                    SimpleFieldset::make('Form')
                        ->schema([
                            Grid::make(5)
                            ->schema([
                            TextInput::make('title')
                                ->label('Course Title')
                                ->placeholder('Enter your course title')
                                ->columnSpan(4)
                                ->required(),
                            SelectIcon::make('icon')
                                ->required()
                                ->columnSpan(1),
                            Select::make('category')
                                ->options(function(){
                                    return tenancy()->central(function ($tenant) {
                                        return CourseCategory::get()->pluck('name', 'id');
                                    });
                                })
                                ->required()
                                ->preload()
                                ->searchable()
                                ->columnSpan(3),
                            TimePicker::make('estimated_time')
                                ->placeholder('HH::mm')->withoutSeconds()->columnSpan(2),
                            Select::make('instructors')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->options(User::get()->pluck('name', 'id'))
                                ->columnSpan('full'),
                            Textarea::make('description')
                                ->placeholder('Enter description')
                                ->required()
                                ->columnSpan('full'),
                            Select::make('tags')
                                ->label('Keywords')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->options(function(){
                                    return tenancy()->central(function ($tenant) {
                                        return Tag::get()->pluck('name', 'id');
                                    });
                                })
                                ->columnSpan('full'),
                            Select::make('passing_score')
                                ->label('Set passing score')
                                ->preload()
                                ->reactive()
                                ->options(function(){
                                    return $this->getScorePercentages();
                                })
                                ->required()
                                ->default(10),
                            Toggle::make('required_passing_modules')->label('Require Passing all Modules?')->inline()->columnSpan(3)
                            ]),
                        ])->columnSpan(3),
                    SimpleFieldset::make('Media')
                        ->columnSpan(2)
                        ->schema([
                            FileUpload::make('image')
                            ->image()
                            ->label('Upload course image')
                            ->columnSpan('full')
                        ]),
                ]),
        ];
    }

    private function getScorePercentages() : array 
    {
        $array = [];

        foreach([0, 50, 60, 70, 80, 90, 100] as $val => $pct)
        {
            $array[$pct] = $pct . '%';
        }

        return $array;
    }
}
