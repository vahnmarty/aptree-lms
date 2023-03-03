@section('header')
    <header class="flex justify-between px-8 py-6">
        <h1 class="text-4xl font-bold leading-7 text-emerald-900 sm:leading-9">Profile</h1>
        <div class="flex gap-6">
            
        </div>
    </header>
@endsection

<div>
    <div class="px-8 py-12 space-y-8 bg-gray-100">
        
        <section>
            @livewire('tenant.user-course-reports')
        </section>
    </div>
</div>
