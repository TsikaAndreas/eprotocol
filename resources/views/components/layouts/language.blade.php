<div x-data="{ languageOpen: false }" {!! $attributes->merge(['class' => 'flex items-center text-gray-700']) !!}>
    <button @click="languageOpen = ! languageOpen"
            class="flex mx-4 focus:outline-none">
        <i class="self-center fas fa-globe-europe"></i><span class="hidden sm:flex">&nbsp;{{__('app.language')}}</span>
    </button>
    <div x-show="languageOpen" @click="languageOpen = false"
         class="fixed inset-0 h-full w-full z-10" style="display: none;">
    </div>
    <div x-show="languageOpen"
         class="absolute w-24 bg-white rounded-md overflow-hidden shadow-xl z-10 mt-24 ml-4 border border-custom-indigo">
        @foreach (\Illuminate\Support\Facades\Config::get('languages') as $lang => $language)
            <a href="{{ route('lang.switch', $lang) }}"
               class="block right-0 pl-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white">
                <span>{{$language}}</span>
            </a>
        @endforeach
    </div>
</div>
