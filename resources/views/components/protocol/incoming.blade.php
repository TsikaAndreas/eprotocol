<div id="protocol-info">
    <div class="section-title mb-6 mt-2 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__("Στοιχεία Πρωτοκόλλου")}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group grid grid-cols-2 gap-x-8">
            <x-form.label for="protocol_date">
                {{__('Ημερομηνία Πρωτοκόλλου')}}
                <x-form.input id="protocol_date" class="block mt-1"
                              type="date" name="protocol_date" value="{{old('protocol_date')}}">
                </x-form.input>
                @error('protocol_date') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
            </x-form.label>
        </div>
        <div class="form-group grid grid-cols-2 gap-x-8">
            <x-form.label for="incoming_protocol">
                {{__('Εισερχομένο Πρωτοκόλλο')}}
                <x-form.input id="incoming_protocol" class="block mt-1"
                              type="text" placeholder="{{__('Αριθμός Πρωτοκόλλου')}}"
                              name="incoming_protocol" value="{{old('incoming_protocol')}}">
                </x-form.input>
                @error('incoming_protocol') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
            </x-form.label>
            <x-form.label for="incoming_protocol_date">
                {{__('Ημερομηνία Εισερχόμενου')}}
                <x-form.input id="incoming_protocol_date" class="block mt-1"
                              type="date" placeholder="DD/MM/YYYY"
                              name="incoming_protocol_date" value="{{old('incoming_protocol_date')}}">
                </x-form.input>
                @error('incoming_protocol_date') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
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
                <x-form.input id="creator" class="block mt-1" type="text"
                              placeholder="Δημιουργός Πρωτοκόλλου" name="creator"
                              value="{{old('creator')}}">
                </x-form.input>
                @error('creator') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
            </x-form.label>
            <x-form.label for="receiver">
                {{__('παραλήπτης')}}
                <x-form.input id="receiver" class="block mt-1" type="text"
                              placeholder="Όνομα παραλήπτη" name="receiver"
                              value="{{old('receiver')}}">
                </x-form.input>
                @error('receiver') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
            </x-form.label>
        </div>
        <div class="form-group">
            <x-form.label for="title">
                {{__('Τίτλος')}}
                <x-form.input id="title" class="block mt-1" type="text"
                              placeholder="Τίτλος Πρωτοκόλλου" name="title"
                              value="{{old('title')}}">
                </x-form.input>
                @error('title') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
            </x-form.label>
        </div>
        <div class="form-group">
            <x-form.label for="description">
                {{__('Περιγραφή')}}
                <x-form.textarea id="description" name="description" placeholder="Περιγραφή Πρωτοκόλλου">
                    {{old('description')}}
                </x-form.textarea>
                @error('description') <span class="text-red-700 text-md">{{ $message }}</span> @enderror
            </x-form.label>
        </div>
    </div>
</div>
