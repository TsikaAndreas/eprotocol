<div id="protocol-info">
    <div class="section-title mb-6 mt-2 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__("Στοιχεία Πρωτοκόλλου")}}</h2>
    </div>

    <div class="form-section m-4">
        <div class="form-group grid grid-cols-2 gap-x-8">
            <x-form.label for="protocol_date">
                {{__('Ημερομηνία Πρωτοκόλλου')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <x-form.span>{{$protocol->protocol_date}}</x-form.span>
                @else
                    <x-form.input id="protocol_date" class="block mt-1"
                                  type="date" name="protocol_date" value="{{isset($protocol) ? $protocol->protocol_date : old('protocol_date')}}">
                    </x-form.input>
                    @error('protocol_date') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </x-form.label>
        </div>
        <div class="form-group grid grid-cols-2 gap-x-8">
            <x-form.label for="ingoing_protocol">
                {{__('Εισερχομένο Πρωτοκόλλο')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <x-form.span>{{$protocol->ingoing_protocol}}</x-form.span>
                @else
                    <x-form.input id="ingoing_protocol" class="block mt-1"
                                  type="text" placeholder="{{__('Αριθμός Πρωτοκόλλου')}}"
                                  name="ingoing_protocol" value="{{isset($protocol) ? $protocol->ingoing_protocol : old('ingoing_protocol')}}">
                    </x-form.input>
                    @error('ingoing_protocol') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </x-form.label>
            <x-form.label for="ingoing_protocol_date">
                {{__('Ημερομηνία Εισερχόμενου')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <x-form.span>{{$protocol->ingoing_protocol_date}}</x-form.span>
                @else
                    <x-form.input id="ingoing_protocol_date" class="block mt-1"
                                  type="date" name="ingoing_protocol_date"
                                  value="{{isset($protocol) ? $protocol->ingoing_protocol_date : old('ingoing_protocol_date')}}">
                    </x-form.input>
                    @error('ingoing_protocol_date') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </x-form.label>
        </div>
    </div>
</div>
<div id="protocol_details">
    <div class="section-title mb-4 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__('Πληροφορίες')}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group grid grid-cols-2 gap-x-8">
            <x-form.label for="author">
                {{__('Δημιουργός')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <x-form.span>{{$protocol->creator}}</x-form.span>
                @else
                    <x-form.input id="creator" class="block mt-1" type="text"
                                  placeholder="Δημιουργός Πρωτοκόλλου" name="creator"
                                  value="{{isset($protocol) ? $protocol->creator : old('creator')}}">
                    </x-form.input>
                    @error('creator') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </x-form.label>
            <x-form.label for="receiver">
                {{__('παραλήπτης')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <x-form.span>{{$protocol->receiver}}</x-form.span>
                @else
                    <x-form.input id="receiver" class="block mt-1" type="text"
                                  placeholder="Όνομα παραλήπτη" name="receiver"
                                  value="{{isset($protocol) ? $protocol->receiver : old('receiver')}}">
                    </x-form.input>
                    @error('receiver') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </x-form.label>
        </div>
        <div class="form-group">
            <x-form.label for="title">
                {{__('Τίτλος')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <x-form.span>{{$protocol->title}}</x-form.span>
                @else
                    <x-form.input id="title" class="block mt-1" type="text"
                                  placeholder="Τίτλος Πρωτοκόλλου" name="title"
                                  value="{{isset($protocol) ? $protocol->title : old('title')}}">
                    </x-form.input>
                    @error('title') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </x-form.label>
        </div>
        <div class="form-group">
            <x-form.label for="description">
                {{__('Περιγραφή')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <x-form.span>{{$protocol->description}}</x-form.span>
                @else
                    <x-form.textarea id="description" name="description" placeholder="Περιγραφή Πρωτοκόλλου">
                        {{isset($protocol) ? $protocol->description : old('description')}}
                    </x-form.textarea>
                    @error('description') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </x-form.label>
        </div>
    </div>
</div>
