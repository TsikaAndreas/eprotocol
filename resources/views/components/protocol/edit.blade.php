<div id="header" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5 p-3">
    {{--Protocol Header--}}
    <div class="p-4 mx-6 flex flex-initial justify-between">
        <div class="self-center">
            <h2 class="text-xl">{{__('Πρωτόκολλο:')}}
                <span id="protocol" class="text-indigo-700">{{isset($protocol->protocol) ? $protocol->protocol : __('Μη καταχωριμένο')}}</span>
            </h2>
        </div>
        <div>
            <a id="backButton" type="button" class="cancel-button" href="{{route('protocol.show',$protocol->id)}}">
                {{__('Ακύρωση')}}
            </a>
            <x-form.submit-button form="updateProtocol">{{__('Υποβολή')}}</x-form.submit-button>
        </div>
    </div>
</div>
<div id="content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
    <form id="updateProtocol" action="{{route('protocol.update',$protocol->id)}}" method="POST">
        @method('PUT')
        @csrf
        @if($protocol->type == 'ingoing')
            <x-protocol.ingoing :protocol="$protocol"></x-protocol.ingoing>
        @elseif ($protocol->type == 'outgoing')
            <x-protocol.outgoing :protocol="$protocol"></x-protocol.outgoing>
        @endif
    </form>
</div>
