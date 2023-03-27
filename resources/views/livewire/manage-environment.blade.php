<div>

    <header class="flex justify-between px-16 py-6 bg-white">
        <div>
            <h1 class="text-3xl font-bold leading-7 text-darkgreen sm:leading-9">Environment</h1>
        </div>
        <div>
            
        </div>
    </header>
    
    <div class="px-16 py-12 bg-gray-100">

        <section class="px-3 py-2 mb-8 bg-red-100">
            <pre class="text-sm">If you are knowledgeable to <a href="https://larave.com" class="font-bold" target="_blank">Laravel</a>, you can edit the <strong>.env</strong> and update its variables.</pre>
        </section>

        <section>
            <h3 class="text-xl font-bold text-emerald-800">Social Media Login</h3>

            <div class="grid gap-6 lg:grid-cols-2">

                <div class="p-6 mt-8 bg-white border rounded-md">
                    <h4 class="mb-8 font-bold text-emerald-800">Facebook</h4>
                    <form action="">
                        {{ $this->facebookForm }}

                        <button type="submit" class="mt-4 btn-primary btn-sm">Save Changes</button>
                    </form>
                    <div class="px-2 py-1 mt-6 bg-yellow-200">
                        <pre class="text-xs"><strong>Note:</strong> You need to declare your data deletion form on Facebook.</pre>
                    </div>
                </div>

                <div class="p-6 mt-8 bg-white border rounded-md">
                    <h4 class="mb-8 font-bold text-emerald-800">Twitter</h4>
                    <form action="">
                        {{ $this->twitterForm }}
                        <button type="submit" class="mt-4 btn-primary btn-sm">Save Changes</button>
                    </form>
                </div>

                <div class="col-span-2 p-6 mt-8 bg-white border rounded-md">
                    <h4 class="mb-8 font-bold text-emerald-800">Google</h4>
                    <form action="">
                        {{ $this->googleForm }}
                        <button type="submit" class="mt-4 btn-primary btn-sm">Save Changes</button>
                    </form>
                </div>

            </div>
        </section>
    </div>
</div>
