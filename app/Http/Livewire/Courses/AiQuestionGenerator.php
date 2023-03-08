<?php

namespace App\Http\Livewire\Courses;

use Livewire\Component;
use App\Enums\ActionType;
use OpenAI\Laravel\Facades\OpenAI;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Concerns\InteractsWithForms;
use Log;

class AiQuestionGenerator extends Component implements HasForms
{
    use InteractsWithForms;

    public $module_id;

    public $action;

    public $prompt;

    public $results;

    protected $listeners = ['createAiQuestion' => 'create'];
    
    public function render()
    {
        return view('livewire.courses.ai-question-generator');
    }

    public function mount($moduleId)
    {
        $this->module_id = $moduleId;

        $this->form->fill([
            'prompt' => "Laravel is a web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things."
        ]);
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
            'content' => 'Write 10 possible questions, each question should have 4 choices and 1 correct answer from this article : "' . $prompt. '". \n Display the result as Json Format.'
        ];

        $messages[] = [
            'role' => 'user',
            'content' => 'Display the result as JSON Format, it should be group under the collection called "questions", Then each item should have a key called "question", "choices", and "answer"'
        ];

        Log::channel('openai')->info(json_encode($messages));

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $messages
        ]);

        $content = $response['choices'][0]['message']['content'];

        $data = $this->parseResult ($content);

        $this->results = $data['questions'];

        //Log::channel('openai')->alert( json_encode($response));
    }

    public function parseResult($content)
    {
        $json = json_encode($content);

        $decode = json_decode($json);

        $data =  json_decode(str_replace("\\\"", "\"", $decode), true);

        return $data;
    }
}
