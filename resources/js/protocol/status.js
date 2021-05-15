$(document).ready(function() {
    let protocolReactivateBtn = document.getElementById('reactivateProtocol');
    let protocolCancelBtn = document.getElementById('cancelProtocol');

    if (protocolReactivateBtn !== null) {
        protocolReactivateBtn.addEventListener('click',reactivateProtocol);
    }
    if (protocolCancelBtn !== null) {
        protocolCancelBtn.addEventListener('click',cancelProtocol);
    }
    let confirmationModal = document.getElementById('confirmationModal');
    confirmationModal.getElementsByClassName('modal-close')[0].addEventListener('click',hideConfirmationModal);
    confirmationModal.getElementsByClassName('modal-cancel')[0].addEventListener('click',hideConfirmationModal);

});

var confirmationModal = document.getElementById('confirmationModal');
var applicationUrl = window.location.origin;

function reactivateProtocol() {
    let protocolId = document.getElementById('reactivateProtocol').value;
    let reactivateMsg = confirmationModal.getElementsByClassName('reactivation-message')[0];
    let submitBtn = confirmationModal.getElementsByClassName('modal-submit')[0];

    reactivateMsg.classList.remove('hidden');
    submitBtn.setAttribute('onclick','statusAjax('+ protocolId + ',\'reactivate\')');
    showConfirmationModal();
}
function cancelProtocol() {
    let protocolId = document.getElementById('cancelProtocol').value;
    let cancelBtn = confirmationModal.getElementsByClassName('cancel-message')[0];
    let submitBtn = confirmationModal.getElementsByClassName('modal-submit')[0];

    cancelBtn.classList.remove('hidden');
    submitBtn.setAttribute('onclick','statusAjax('+ protocolId + ',\'cancel\')');
    showConfirmationModal();
}
statusAjax = function (protocolId,action){
    let confirmationMsg = confirmationModal.getElementsByClassName('modal-message')[0];

    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': csrf_token }
    });
    $.ajax({
        url: applicationUrl + '/protocol/' + protocolId + '/' + action,
        method: "post",
        dataType: "json",
        data: {
            protocol_id: protocolId
        }
    }).done( function (result) {
        hideInitialMessages();
        if (result.success) {
            confirmationMsg.innerHTML = '<p class="text-green-500">' + result.message + '</p>';
        } else if (result.error) {
            confirmationMsg.innerHTML = '<p class="text-red-500">' + result.message + '</p>';
        }
    }).fail( function (result) {
        hideInitialMessages();
        confirmationMsg.innerHTML = '<p class="text-red-500">' + result.statusText + '</p>';
        confirmationMsg.innerHTML += '<p>' + result.responseText + '</p>';
    });
}

function hideConfirmationModal() {
    confirmationModal.classList.add('hidden');
    confirmationModal.getElementsByClassName('modal-message')[0].innerText = '';
    hideInitialMessages();
}
function hideInitialMessages(){
    let cancelMsg = confirmationModal.getElementsByClassName('cancel-message')[0];
    let reactivateMsg = confirmationModal.getElementsByClassName('reactivation-message')[0];

    if (!cancelMsg.classList.contains('hidden')){
        cancelMsg.classList.add('hidden');
    }
    if (!reactivateMsg.classList.contains('hidden')){
        reactivateMsg.classList.add('hidden');
    }
}
function showConfirmationModal() {
    confirmationModal.classList.remove('hidden');
}
