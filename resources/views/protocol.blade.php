<x-app-layout>
    <x-layouts.page-header :title="$title"></x-layouts.page-header>
    <div class="py-4">
        <div class="max-w-3md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
{{--                <div class="p-6 bg-white border-b border-gray-200">--}}
                    <form action="{{route('protocol.store')}}" method="POST">
                        @csrf
                        <!-- Protocol Header -->
                        <div class="header-section border-b">
                            <div class="header-section p-4 mx-6 flex flex-initial justify-between">
                                <div class="self-center">
                                    <h2 class="text-xl">{{__('Πρωτόκολλο:')}}
                                    <span id="protocol" class="text-indigo-700">{{__('Μη καταχωριμένο')}}</span></h2>
                                </div>
                                <div>
                                    <x-form.cancel-button>{{__('Ακύρωση')}}</x-form.cancel-button>
                                    <x-form.submit-button>{{__('Υποβολή')}}</x-form.submit-button>
                                </div>
                            </div>
                        </div>
                        <!-- Protocol Content -->
                        <div class="content-section p-6">
                            <x-protocol.incoming-protocol></x-protocol.incoming-protocol>
                        </div>

                    </form>
{{--                </div>--}}
            </div>
        </div>
    </div>
</x-app-layout>
