<?php

namespace App\Http\Livewire\Courses;

use Log;
use App\Models\Module;
use Livewire\Component;
use App\Enums\ActionType;
use App\Enums\QuestionType;
use App\Enums\ModuleItemType;
use OpenAI\Laravel\Facades\OpenAI;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Filament\Forms\Concerns\InteractsWithForms;

class AiQuestionGenerator extends Component implements HasForms
{
    use InteractsWithForms;
    use LivewireAlert;

    public $module_id;

    public $action;

    public $prompt;

    public $results = [];

    protected $listeners = ['createAiQuestion' => 'create'];
    
    public function render()
    {
        return view('livewire.courses.ai-question-generator');
    }

    public function mount($moduleId)
    {
        $this->module_id = $moduleId;
    }

    protected function getFormSchema()
    {
        return [
            Textarea::make('prompt')->rows(10)->label('Question Generator')->placeholder('No more than 500 words')
        ];
    }

    public function create()
    {
        $this->action = ActionType::Create;
        $this->dispatchBrowserEvent('openmodal-aiquestion');
    }

    public function submit()
    {
        
        $data = $this->form->getState();

        $prompt = $data['prompt'];

        $messages[] = [
            'role' => 'user', 
            'content' => 'Write 3 possible questions, each question should have 4 choices and 1 correct answer from this article : "' . $prompt. '"'
        ];

        $token = config('services.openai.chatgpt.questgen');

        $messages[] = [
            'role' => 'user',
            'content' => decrypt($token)
        ];

        Log::channel('openai')->info(json_encode($messages));

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages
        ]);

        // OpenAI returns choices array, so select the first one
        $content = $response['choices'][0]['message']['content'];

        $data = $this->parseResult ($content);

        $this->results = $data['questions'];
    }

    public function parseResult($content)
    {
        // $content is a text result, so convert it into a json
        $json = json_encode($content);

        $decode = json_decode($json);

        // this is to delete unnecessary strings
        $data =  json_decode(str_replace("\\\"", "\"", $decode), true);

        return $data;
    }

    public function insert($index)
    {
        $result = $this->results[$index];

        Log::channel('openai')->info(json_encode($result));

        $this->createQuestion($result);

        $this->results[$index]['hidden'] = true;
    }

    public function createQuestion($data)
    {
        $module = Module::find($this->module_id);

        $module_question = $module->items()->create([
            'type' => ModuleItemType::Question,
            'title' => $data['question'],
        ]);

        $question = $module_question->question()->create([
            'title' => $data['question'],
            'type' => QuestionType::Ai,
            'description' => '',
            'explanation' => $data['explanation'],
            'display_explanation' => true,
        ]);

        foreach($data['choices'] as $i => $answer)
        {
            $question->answers()->create([
                'answer' => $answer,
                'is_correct' => $i == 0 ? true : false
            ]);
        }

        $this->alert('success', 'Question added successfully!');
    }
}
