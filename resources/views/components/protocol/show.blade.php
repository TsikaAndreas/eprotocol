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
            @if($protocol->status === \App\Models\Protocol::CANCELED)
                <button id="reactivateProtocol" type="button" class="status-button" value="{{$protocol->id}}">{{__('protocol.reactivate')}}</button>
            @elseif($protocol->status === \App\Models\Protocol::ACTIVE)
                <button id="cancelProtocol" type="button" class="status-button" value="{{$protocol->id}}">{{__('protocol.cancel')}}</button>
            @endif
            <x-form.cancel-button>{{__('protocol.back')}}</x-form.cancel-button>
            <a id="editProtocol" type="button" class="submit-button"
            href="{{route('protocol.edit',$protocol->id)}}">
                {{__('protocol.edit')}}
            </a>
        </div>
    </div>
</div>
<div id="content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        @if($protocol->type == 'ingoing')
            <x-protocol.ingoing :protocol="$protocol" :mode="$preview" :files="$files"></x-protocol.ingoing>
        @elseif ($protocol->type == 'outgoing')
            <x-protocol.outgoing :protocol="$protocol" :mode="$preview" :files="$files"></x-protocol.outgoing>
        @endif
</div>
