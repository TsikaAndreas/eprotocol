<div id="header" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-3">
    {{--Protocol Header--}}
    <div class="p-2 mx-6 flex flex-initial justify-between">
        <div class="self-center">
            <h2 class="text-xl">{{__('protocol.protocol')}}
                <span id="protocol" class="text-indigo-700">{{isset($protocol->protocol) ? $protocol->protocol : __('protocol.no_registered')}}</span>
            </h2>
            <h2 class="text-xl mt-1">{{__('protocol.status')}}
                {!! $protocol->badge !!}
            </h2>
        </div>
        <div>
            <a id="backButton" type="button" class="cancel-button" href="{{route('protocol.show',$protocol->id)}}">
                {{__('protocol.back')}}
            </a>
            <x-form.submit-button form="updateProtocol">{{__('protocol.submit')}}</x-form.submit-button>
        </div>
    </div>
</div>

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

<div id="content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 relative">
    <x-loader>{{__('message.submitting')}}</x-loader>
    <form id="updateProtocol" action="{{route('protocol.update',$protocol)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
            <input type="hidden" name="type" value="{{$protocol->type}}">
        @if($protocol->type == 'incoming')
            <x-protocol.incoming :protocol="$protocol" :mode="$preview" :files="$files"></x-protocol.incoming>
        @elseif ($protocol->type == 'outgoing')
            <x-protocol.outgoing :protocol="$protocol" :mode="$preview" :files="$files"></x-protocol.outgoing>
        @endif
    </form>
</div>
