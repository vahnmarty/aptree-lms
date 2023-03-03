<form action="" wire:submit.prevent="submit">
    {{ $this->form }}

    <div class="flex items-center justify-between pt-4 mt-8 border-t">
        <p class="text-xl font-bold text-emerald-900">Add Content</p>
        <div class="flex gap-2">
            <button type="button" class="btn-default">Refresh</button>
            <button type="button" class="btn-default">Cancel</button>
            <button type="submit" class="btn-primary">Save</button>
        </div>
    </div>
</form>