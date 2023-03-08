<form action="" wire:submit.prevent="submit">
    {{ $this->form }}

    @if(  count($results) )
    <h2>Results</h2>
    <div class="pt-4 space-y-4 border-t">
        @foreach($results as $result)
        <div class="p-4 border border-gray-300 rounded-md">
            <div class="flex">
                <div class="flex-1">
                    <div>{{ $result['question'] }}</div>
                    <div class="flex flex-col mt-4 space-y-4">
                        @foreach($result['choices'] as $choice)
                        <label class="flex items-center gap-2">
                            <input type="radio" value="{{ $choice }}">
                            <span>{{ $choice }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                <div>
                    <button type="button" class="btn-primary">Insert</button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <div class="py-4 pt-8 mt-16 border-t">
        <div class="flex justify-between">
            <h1 class="text-lg font-bold text-darkgreen">AI Question Generator</h1>
            <div>
                <div class="flex gap-3">
                    <button  type="button" class="btn-light" x-on:click="closeModal()">Cancel</button>
                    <button type="submit" class="btn-primary btn-sm"><x-loading/> Generate</button>
                </div>
            </div>
        </div>
    </div>
    
</form>