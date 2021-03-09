<div>
    <div>
        <h4>{{__("Protocol Details")}}</h4>
    </div>
    <div class="flex">
        <x-form.label for="protocol_id" class="mr-40">
            {{__('Protocol No')}}
            <x-form.input id="protocol_id" class="block mt-1 w-full"
                          type="text" placeholder="Protocol No"
                          name="protocol_id"
                          required autofocus autocomplete="off" />
        </x-form.label>
        <x-form.label for="protocol_id">
            {{__('Protocol Date')}}
            <x-form.input id="protocol_date" class="block mt-1 w-full"
                          type="text" placeholder="DD/MM/YYYY"
                          name="protocol_date" pattern="((0[1-9]|[12]\d|3[01])\/(0[1-9]|1[0-2])\/[12]\d{3})"
                          required autofocus autocomplete="off" />
        </x-form.label>
    </div>

</div>
