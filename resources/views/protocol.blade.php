<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3md mx-auto sm:px-6 lg:px-8">
            <div id="header" class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-5">
                {{--Protocol Header--}}
                <div class="p-4 mx-6 flex flex-initial justify-between">
                    <div class="self-center">
                        <h2 class="text-xl">{{__('Πρωτόκολλο:')}}
                            <span id="protocol" class="text-indigo-700">{{__('Μη καταχωριμένο')}}</span>
                        </h2>
                    </div>
                    <div>
                        <x-form.cancel-button>{{__('Ακύρωση')}}</x-form.cancel-button>
                        <x-form.submit-button form="createProtocol">{{__('Υποβολή')}}</x-form.submit-button>
                    </div>
                </div>
            </div>
            <div id="content" class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form id="createProtocol" action="{{route('protocol.store')}}" method="POST">
                    @csrf
                    {{--Protocol Content--}}
                    <input type="hidden" name="type" value="{{$type}}">
                    @if($type == 'incoming')
                        <x-protocol.incoming></x-protocol.incoming>
                    @elseif ($type == 'outgoing')
                        <x-protocol.outgoing></x-protocol.outgoing>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
