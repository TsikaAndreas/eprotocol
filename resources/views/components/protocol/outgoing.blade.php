<div id="protocol-info">
    <div class="section-title mb-6 mt-2 border-b border-blue-800 text-blue-800">
        <h2 class="text-xl pl-4 pb-2">{{__("Στοιχεία Πρωτοκόλλου")}}</h2>
    </div>
    <div class="form-section m-4">
        <div class="form-group grid grid-cols-2 gap-x-8">
            <x-form.label for="incoming_protocol_no">
                {{__('Εισερχομένο Πρωτοκόλλο')}}
                <x-form.input id="incoming_protocol_no" class="block mt-1"
                              type="text" placeholder="{{__('Αριθμός Πρωτοκόλλου')}}"
                              name="incoming_protocol_no">
                </x-form.input>
            </x-form.label>
            <x-form.label for="incoming_protocol_date">
                {{__('Ημερομηνία Εισερχόμενου')}}
                <x-form.input id="incoming_protocol_date" class="block mt-1"
                              type="date" placeholder="DD/MM/YYYY"
                              name="incoming_protocol_date">
                </x-form.input>
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
                {{__('Αποστολέας')}}
                <x-form.input id="author" class="block mt-1" type="text"
                              placeholder="Όνομα Αποστολέα" name="sender">
                </x-form.input>
            </x-form.label>
            <x-form.label for="receiver">
                {{__('παραλήπτης')}}
                <x-form.input id="receiver" class="block mt-1" type="text"
                              placeholder="Όνομα παραλήπτη" name="receiver">
                </x-form.input>
            </x-form.label>
        </div>
        <div class="form-group">
            <x-form.label for="title">
                {{__('Τίτλος')}}
                <x-form.input id="title" class="block mt-1" type="text"
                              placeholder="Τίτλος Πρωτοκόλλου" name="title">
                </x-form.input>
            </x-form.label>
        </div>
        <div class="form-group">
            <x-form.label for="description">
                {{__('Περιγραφή')}}
                <x-form.textarea id="description" name="description" placeholder="Περιγραφή Πρωτοκόλλου">
                </x-form.textarea>
            </x-form.label>
        </div>
    </div>
</div>
