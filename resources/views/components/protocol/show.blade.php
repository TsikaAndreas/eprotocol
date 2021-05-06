<div id="header" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-3">
    {{--Protocol Header--}}
    <div class="p-2 mx-6 flex flex-initial justify-between">
        <div class="self-center">
            <h2 class="text-xl">{{__('Πρωτόκολλο:')}}
                <span id="protocol" class="text-indigo-700">{{isset($protocol->protocol) ? $protocol->protocol : __('Μη καταχωριμένο')}}</span>
            </h2>
            <h2 class="text-xl mt-1">{{__('Κατάσταση:')}}
                <span id="protocol_status" class="text-indigo-700">{{$protocol->status}}</span>
            </h2>
        </div>
        <div>
            <x-form.cancel-button>{{__('Πίσω')}}</x-form.cancel-button>
            <a id="editProtocol" type="button" class="submit-button"
            href="{{route('protocol.edit',$protocol->id)}}">
                {{__('Επεξεργασία')}}
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
