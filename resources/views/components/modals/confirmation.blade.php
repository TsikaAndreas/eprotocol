<div id="confirmationModal" class="modal hidden z-30 custom-modal" role="dialog">
    <div class="modal-content custom-modal-content">
        <div class="modal-header custom-modal-header">
            <span class="self-center text-xl">{{__('Confirmation')}}</span>
            <button type="button" class="modal-close text-3xl">&times;</button>
        </div>
        <div class="modal-body py-4 px-8">
            <p class="hidden reactivation-message text-lg">
                {{__('Are you sure you want to continue with the reactivation action?')}}
            </p>
            <p class="hidden cancel-message text-lg">
                {{__('Are you sure you want to proceed with the cancellation action?')}}
            </p>
            <p class="modal-message text-lg"></p>
        </div>
        <div class="modal-footer md:text-right text-center px-6 py-6">
            <button class="modal-cancel cancel-button">{{__('Cancel')}}</button>
            <button class="modal-submit status-button">{{__('Confirm')}}</button>
        </div>
    </div>
</div>

@push('footer-scripts')
    <script type="text/javascript" src="{{ asset('js/protocol/status.min.js') }}"></script>
@endpush

