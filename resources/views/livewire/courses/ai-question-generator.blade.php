<form action="" wire:submit.prevent="submit">
    @if( count($results) )
    <div class="pt-4 space-y-4 border-t">
        @foreach($results as $r => $result)
            @if( empty($result['hidden']) )
            <div x-data="{}" x-ref="parent" class="p-6 border border-gray-300 rounded-md">
                <div class="flex">
                    <div class="flex-1">
                        <div>{{ $result['question'] }}</div>
                        <div class="flex flex-col mt-4 space-y-4">
                            @foreach($result['choices'] as $index => $choice)
                            <label class="flex items-center gap-2">
                                @if($index == 0)
                                <input type="radio" value="{{ $choice }}" checked>
                                @else
                                <input type="radio" value="{{ $choice }}">
                                @endif
                                <span>{{ $choice }}</span>
                            </label>
                            @endforeach
                        </div>
                        <div class="pt-4 mt-4 border-t">
                            <h4 class="font-bold text-darkgreen">Explanation</h4>
                            <div class="mt-4 text-sm text-gray-700">{!! $result['explanation'] !!}</div>
                        </div>
                    </div>
                    <div>
                        <button wire:click="insert(`{{ $r }}`)" type="button" class="btn-primary">Insert & Edit</button>
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>
    @else
    {{ $this->form }}
    @endif

    <div class="py-4 pt-8 mt-16 border-t">
        <div class="flex justify-between">
            <h1 class="text-lg font-bold text-darkgreen">AI Question Generator</h1>
            <div>
                <div class="flex gap-3">
                    <button type="button" class="btn-light" x-on:click="closeModal()">Close</button>
                    @if(!count($results))
                    <button type="submit" class="btn-primary btn-sm"><x-loading/> Generate</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</form>