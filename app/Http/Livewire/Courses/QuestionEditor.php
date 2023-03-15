<?php

namespace App\Http\Livewire\Courses;

use Closure;
use App\Models\Module;
use Livewire\Component;
use App\Models\Question;
use App\Enums\ActionType;
use App\Models\ModuleItem;
use App\Enums\QuestionType;
use App\Enums\ModuleItemType;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Contracts\HasForms;
use App\Forms\Components\DynamicOption;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use App\Forms\Components\SimpleFieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Concerns\InteractsWithForms;

class QuestionEditor extends Component implements HasForms
{
    use InteractsWithForms;

    public $action;

    public $title, $type, $answers = [], $description, $explanation, $display_explanation;

    public $module_item_id, $question_id;

    protected $listeners = [ 'createQuestion' => 'create' , 'editQuestion' => 'edit'];
    
    public function render()
    {
        return view('livewire.courses.question-editor');
    }

    public function mount($moduleId)
    {
        $this->module_id = $moduleId;

        if($this->action == ActionType::Create){
            $this->answers = $this->getDefaultAnswers();
        }
        
    }

    public function create($module_id, $type)
    {
        $this->action = ActionType::Create;
        $this->type = $type;
        $this->module_id = $module_id;
        $this->dispatchBrowserEvent('openmodal-question');
    }

    public function edit($id)
    {
        $this->action = ActionType::Update;
        $this->module_item_id = $id;
        $moduleItem = ModuleItem::find($id);
        $question = $moduleItem->question;
        $this->question_id = $question->id;

        $this->form->fill([
            'title' => $question->title,
            'description' => $question->description,
            'explanation' => $question->explanation,
            'display_explanation' => $question->display_explanation,
            'answers' => $question->getAnswerArray()
        ]);

        //dd($question->getAnswerArray(), $this->form->getState());

        $this->dispatchBrowserEvent('openmodal-question');
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(2)
                ->schema([
                SimpleFieldset::make('question')
                    ->schema([
                        TextInput::make('title')->label('Question')->placeholder('Enter your question here.')->required(),
                        Textarea::make('description')->rows(3)->placeholder('Description (Optional)'),
                        Textarea::make('explanation')->rows(3)->placeholder('Explanation Text')->required(),
                        Toggle::make('display_explanation')->label('Display Explanation?')->inline()
                    ])
                    ->columnSpan(1),
                Fieldset::make('answers')
                    ->label('Create your Answers')
                    ->schema([
                        DynamicOption::make('answers')
                        ->keyLabel('Option')
                        ->valueLabel('Is Correct')
                        ->columnSpan('full')
                        ->addButtonLabel('Add Answer')
                        ->rules([
                            function () {
                                return function ($attribute, $value, Closure $fail) {
                                    $options = $value;
                                    $selected = 0;

                                    foreach($options as $left => $option){
                                        if($option == true){
                                            $selected++;
                                            break;
                                        }
                                    }

                                    if ($selected <= 0) {
                                        $fail("The {$attribute} is invalid. Please mark a correct answer.");
                                    }
                                };
                            },
                        ])
                    ])->columnSpan(1)
            ])
        ];
    }

    public function getDefaultAnswers()
    {
        return [ 'Correct Answer 1' => true, 'Wrong Answer 1' => false, 'Wrong Answer 2' => false];
    }

    public function store()
    {
        $data = $this->form->getState();
        

        $module = Module::find($this->module_id);

        $module_question = $module->items()->create([
            'type' => ModuleItemType::Question,
            'title' => $data['title'],
        ]);

        $question = $module_question->question()->create([
            'title' => $data['title'],
            'type' => QuestionType::MultipleChoice,
            'description' => $data['description'],
            'explanation' => $data['explanation'],
            'display_explanation' => $data['display_explanation'],
        ]);

        foreach($this->answers as $answerText => $answerValue)
        {
            $question->answers()->create([
                'answer' => $answerText,
                'is_correct' => $answerValue ? true : false
            ]);
        }

        return redirect(request()->header('Referer'));
    }

    public function update()
    {
        $data = $this->form->getState();

        $module_item = ModuleItem::find($this->module_item_id);
        $question = Question::find($this->question_id);

        $module_item->update([
            'title' => $data['title'],
        ]);

        $question->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'explanation' => $data['explanation'],
            'display_explanation' => $data['display_explanation'],
        ]);

        $question->answers()->delete();

        foreach($this->answers as $answerText => $answerValue)
        {
            $question->answers()->create([
                'answer' => $answerText,
                'is_correct' => $answerValue ? true : false
            ]);
        }

        return redirect(request()->header('Referer'));
    }

    public function submit()
    {
        $this->validate();

        $form = $this->form->getState();
        

        if($this->action == ActionType::Update)
        {
            return $this->update();
        }else{
            return $this->store();
        }

        
        
    }
    
}
