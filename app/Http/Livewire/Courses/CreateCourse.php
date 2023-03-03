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
use App\Models\CourseSubcategory;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Forms\Components\SimpleFieldset;
use App\Forms\Components\SelectIcon;

class CreateCourse extends Component implements HasForms
{   
    use InteractsWithForms;

    public $course;

    public $title, $icon = 'education', $passing_score = 70;
    public $category_id, $subcategories = [], $estimated_time, $instructors = [], $description, $tags = [];
    public $required_passing_modules;
    public $image;
    
    public function render()
    {
        return view('livewire.courses.create-course');
    }

    public function mount()
    {
        
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make([
                'default' => 1,
                'sm' => 1,
                'lg' => 5,
            ])
                ->schema([
                    SimpleFieldset::make('Form')
                        ->schema([
                            Grid::make(['default' => 1, 'lg' => 6])
                            ->schema([
                            TextInput::make('title')
                                ->label('Course Title')
                                ->placeholder('Enter your course title')
                                ->columnSpan(['default' => 6, 'sm' => 5, 'md' => 5])
                                ->required(),
                            SelectIcon::make('icon')
                                ->label('Select Icon')
                                ->required()
                                ->columnSpan(['lg' => 1, 'xl' => 1, 'default' => 2]),
                            Select::make('category_id')
                                ->label('General Category')
                                ->options(function(){
                                    return CourseCategory::get()->pluck('name', 'id');
                                })
                                ->required()
                                ->preload()
                                ->searchable()
                                ->columnSpan(['default' => 6, 'md' => 3]),
                            Select::make('subcategories')
                                ->label('Specific Category')
                                ->columnSpan(['default' => 6, 'md' => 3])
                                ->options(function(){
                                    return CourseSubcategory::where('course_category_id', $this->category_id)->get()->pluck('name', 'id');
                                })
                                ->reactive()
                                ->required()
                                ->preload()
                                ->searchable(),
                            Select::make('instructors')
                                ->multiple()
                                ->searchable()
                                ->preload()
                                ->options(User::get()->pluck('name', 'id'))
                                ->columnSpan(['default' => 6]),
                            Textarea::make('description')
                                ->placeholder('Enter description')
                                ->required()
                                ->columnSpan(['default' => 6]),
                            // Select::make('tags')
                            //     ->label('Keywords')
                            //     ->multiple()
                            //     ->searchable()
                            //     ->preload()
                            //     ->options(function(){
                            //         return tenancy()->central(function ($tenant) {
                            //             return Tag::get()->pluck('name', 'id');
                            //         });
                            //     })
                            //     ->columnSpan('full'),

                            TimePicker::make('estimated_time')
                                ->placeholder('HH::mm')
                                ->withoutSeconds()
                                ->columnSpan(['default' => 3, 'md' => 2]),
                            Select::make('passing_score')
                                ->label('Passing score')
                                ->preload()
                                ->reactive()
                                ->options(function(){
                                    return $this->getScorePercentages();
                                })
                                ->required()
                                ->default(10)
                                ->columnSpan(['default' => 3, 'md' => 1]),
                            Toggle::make('required_passing_modules')
                                ->label('Require Passing all Modules?')
                                ->inline()
                                ->columnSpan(['default' => 6, 'md' => 2]),
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
    
    protected function getFormModel(): string
    {
        return Course::class;
    }

    public function submit()
    {
        $data = $this->form->getState();


        # Create Course
        $course = new Course;
        $course->title = $data['title'];
        $course->icon = $data['icon'];
        $course->description = $data['description'];
        $course->category_id = $data['category_id'];
        $course->estimated_time = $data['estimated_time'];
        $course->required_passing_modules = $data['required_passing_modules'];
        $course->passing_score = $data['passing_score'];
        $course->image = $data['image'];
        $course->status = CourseStatus::Draft;
        $course->slug = Str::slug($data['title']);
        $course->save();
    

        try {
            # Relationships
            $course->subcategories()->attach($data['subcategories']);
            $course->instructors()->attach($data['instructors']);

        } catch (\Throwable $th) {

            throw $th;
        }
        
        return redirect()->route('courses.contents', ['id' => $course->id]);

    }
}
