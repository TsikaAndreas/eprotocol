<div id="protocol-info">
    <div class="section-title mb-6 mt-2 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__("Στοιχεία Πρωτοκόλλου")}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group grid grid-cols-2 gap-x-8">
            <label for="protocol_date" class="custom-label">
                {{__('Ημερομηνία Πρωτοκόλλου')}}
                @if(isset($mode) && ($mode === 'PREVIEW' || $mode === 'EDIT'))
                    <span class="custom-span">{{$protocol->protocol_date}}</span>
                @else
                    <input id="protocol_date" class="block mt-1 custom-input"
                                  type="date" name="protocol_date" value="{{isset($protocol) ? $protocol->protocol_date : old('protocol_date')}}">
                    @error('protocol_date') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
        <div class="form-group grid grid-cols-2 gap-x-8">
            <label for="ingoing_protocol" class="custom-label">
                {{__('Εισερχομένο Πρωτοκόλλο')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->ingoing_protocol}}</span>
                @else
                    <input id="ingoing_protocol" class="block mt-1 custom-input"
                                  type="text" placeholder="{{__('Αριθμός Πρωτοκόλλου')}}"
                                  name="ingoing_protocol" value="{{isset($protocol) ? $protocol->ingoing_protocol : old('ingoing_protocol')}}">
                    @error('ingoing_protocol') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
            <label for="ingoing_protocol_date" class="custom-label">
                {{__('Ημερομηνία Εισερχόμενου')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->ingoing_protocol_date}}</span>
                @else
                    <input id="ingoing_protocol_date" class="block mt-1 custom-input"
                                  type="date" name="ingoing_protocol_date"
                                  value="{{isset($protocol) ? $protocol->ingoing_protocol_date : old('ingoing_protocol_date')}}">
                    @error('ingoing_protocol_date') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
    </div>
</div>

<div id="protocol_details">
    <div class="section-title mb-4 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__('Πληροφορίες')}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group grid grid-cols-2 gap-x-8">
            <label for="author" class="custom-label">
                {{__('Δημιουργός')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->creator}}</span>
                @else
                    <input id="creator" class="block mt-1 custom-input" type="text"
                                  placeholder="Δημιουργός Πρωτοκόλλου" name="creator"
                                  value="{{isset($protocol) ? $protocol->creator : old('creator')}}">
                    @error('creator') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
            <label for="receiver" class="custom-label">
                {{__('παραλήπτης')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->receiver}}</span>
                @else
                    <input id="receiver" class="block mt-1 custom-input" type="text"
                                  placeholder="Όνομα παραλήπτη" name="receiver"
                                  value="{{isset($protocol) ? $protocol->receiver : old('receiver')}}">
                    @error('receiver') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
        <div class="form-group">
            <label for="title" class="custom-label">
                {{__('Τίτλος')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->title}}</span>
                @else
                    <input id="title" class="block mt-1 custom-input" type="text"
                                  placeholder="Τίτλος Πρωτοκόλλου" name="title"
                                  value="{{isset($protocol) ? $protocol->title : old('title')}}">
                    @error('title') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
        <div class="form-group">
            <label for="description" class="custom-label">
                {{__('Περιγραφή')}}
                @if(isset($mode) && $mode === 'PREVIEW')
                    <span class="custom-span">{{$protocol->description}}</span>
                @else
                    <textarea id="description" name="description" placeholder="Περιγραφή Πρωτοκόλλου"
                              class="custom-textarea">{{isset($protocol) ? $protocol->description : old('description')}}</textarea>
                    @error('description') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
                @endif
            </label>
        </div>
    </div>
</div>

<div id="protocol_files">
    <div class="section-title mb-4 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__('Έγγραφα')}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group">
            <label for="description" class="custom-label">
                {{__('Επιλέξτε αρχείο')}}
                    <input type="file" name="file[1]" placeholder="Επιλέξτε αρχείο" class="block mt-1">
                        {{isset($protocol) ? $protocol->file : old('file_0')}}
                    @error('file_0') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
            </label>
        </div>
    </div>
</div>

