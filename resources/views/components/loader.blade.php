<div id="form-loader" class="hidden">
    <div class="overlay -m-6"></div>
    <div class="loader -m-16">
        <div class="content text-center bg-white p-4 rounded-xl">
            <img class="m-auto" src="{{asset('assets/gifs/loading.gif')}}">
            <p class="px-4 pt-3">{{ $slot }}</p>
        </div>
    </div>
</div>
