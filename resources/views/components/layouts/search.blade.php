<div class="mx-4">
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
        <i class="fas fa-search text-gray-500"></i>
    </span>
    <input id="globalSearch" class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text" placeholder="{{__('app.search')}}">
    <div class="bg-white border-1 border-black z-40">
    </div>
</div>

@push('footer-scripts')
    <script type="text/javascript" src="{{ asset('js/global-search.js') }}"></script>
@endpush
