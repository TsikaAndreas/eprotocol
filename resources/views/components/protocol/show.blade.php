<div id="header" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
    {{--Protocol Header--}}
    <div class="p-4 mx-6 flex flex-initial justify-between">
        <div class="self-center">
            <h2 class="text-xl">{{__('Πρωτόκολλο:')}}
                <span id="protocol" class="text-indigo-700">{{isset($protocol->protocol) ? $protocol->protocol : __('Μη καταχωριμένο')}}</span>
            </h2>
        </div>
        <div>
            <x-form.cancel-button>{{__('Ακύρωση')}}</x-form.cancel-button>
            <x-form.submit-button>{{__('Επεξεργασία')}}</x-form.submit-button>
        </div>
    </div>
</div>
<div id="content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        @if($protocol->type == 'ingoing')
            <x-protocol.ingoing :protocol="$protocol" :mode="$preview"></x-protocol.ingoing>
        @elseif ($protocol->type == 'outgoing')
            <x-protocol.outgoing :protocol="$protocol" :mode="$preview"></x-protocol.outgoing>
        @endif
</div>
