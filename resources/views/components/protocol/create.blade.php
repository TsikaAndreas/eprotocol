<div id="header" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
    {{--Protocol Header--}}
    <div class="p-4 mx-6 flex flex-initial justify-between">
        <div class="self-center">
            <h2 class="text-xl">{{__('Πρωτόκολλο:')}}
                <span id="protocol" class="text-indigo-700">{{__('Μη καταχωριμένο')}}</span>
            </h2>
        </div>
        <div>
            <x-form.cancel-button>{{__('Πίσω')}}</x-form.cancel-button>
            <x-form.submit-button form="createProtocol">{{__('Υποβολή')}}</x-form.submit-button>
        </div>
    </div>
</div>

@error('type')
<div id="content" class="bg-red-100 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-5">
    <span> {{ $message }} </span>
</div>
@enderror
@error('file.*')
<div id="content" class="bg-red-100 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-5">
    @foreach($errors->get('file.*') as $errors)
        @foreach($errors as $error)
            <span> {{ $error }} </span>
            <br>
        @endforeach
    @endforeach
</div>
@enderror

<div id="content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <form id="createProtocol" action="{{route('protocol.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{--Protocol Content--}}
        <input type="hidden" name="type" value="{{$type}}">
        @if($type == 'ingoing')
            <x-protocol.ingoing :mode="$preview"></x-protocol.ingoing>
        @elseif ($type == 'outgoing')
            <x-protocol.outgoing :mode="$preview"></x-protocol.outgoing>
        @endif
    </form>
</div>
