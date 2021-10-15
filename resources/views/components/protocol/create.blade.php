<div id="header" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
    {{--Protocol Header--}}
    <div class="p-4 mx-6 flex flex-initial justify-between">
        <div class="self-center">
            <h2 class="text-xl">{{__('protocol.protocol')}}
                <span id="protocol" class="text-indigo-700">{{__('protocol.no_registered')}}</span>
            </h2>
        </div>
        <div>
            <x-form.cancel-button>{{__('protocol.back')}}</x-form.cancel-button>
            <x-form.submit-button form="createProtocol">{{__('protocol.submit')}}</x-form.submit-button>
        </div>
    </div>
</div>

<div id="content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 relative">
    <x-loader>{{__('message.submitting')}}</x-loader>
    <form id="createProtocol" action="{{route('protocol.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        {{--Protocol Content--}}
        <input type="hidden" name="type" value="{{$type}}">
        @if($type == 'incoming')
            <x-protocol.incoming :mode="$preview"></x-protocol.incoming>
        @elseif ($type == 'outgoing')
            <x-protocol.outgoing :mode="$preview"></x-protocol.outgoing>
        @endif
    </form>
</div>
