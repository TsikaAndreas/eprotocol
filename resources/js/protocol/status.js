$(document).ready(function() {
    let protocolReactivateBtn = document.getElementById('reactivateProtocol');
    let protocolCancelBtn = document.getElementById('cancelProtocol');

    if (protocolReactivateBtn !== null) {
        protocolReactivateBtn.addEventListener('click',reactivateProtocol);
    }
    if (protocolCancelBtn !== null) {
        protocolCancelBtn.addEventListener('click',cancelProtocol);
    }
    let changeStatusModal = document.getElementById('changeProtocolStatusModal');
    changeStatusModal.getElementsByClassName('modal-close')[0].addEventListener('click',hideChangeStatusModal);
    changeStatusModal.getElementsByClassName('modal-cancel')[0].addEventListener('click',hideChangeStatusModal);

});

var changeStatusModal = document.getElementById('changeProtocolStatusModal');
// Reactivate Protocol Action
function reactivateProtocol() {
    let protocolId = document.getElementById('reactivateProtocol').value;
    let reactivateMsg = changeStatusModal.getElementsByClassName('reactivation-message')[0];
    let submitBtn = changeStatusModal.getElementsByClassName('modal-submit')[0];

    reactivateMsg.classList.remove('hidden');
    submitBtn.setAttribute('onclick','protocolStatusAjax('+ protocolId + ',\'reactivate\')');
    showChangeStatusModal();
}
// Cancel Protocol Action
function cancelProtocol() {
    let protocolId = document.getElementById('cancelProtocol').value;
    let cancelBtn = changeStatusModal.getElementsByClassName('cancel-message')[0];
    let submitBtn = changeStatusModal.getElementsByClassName('modal-submit')[0];

    cancelBtn.classList.remove('hidden');
    submitBtn.setAttribute('onclick','protocolStatusAjax('+ protocolId + ',\'cancel\')');
    showChangeStatusModal();
}
// Ajax request for status change.
protocolStatusAjax = function (protocolId,action){
    let confirmationMsg = changeStatusModal.getElementsByClassName('modal-message')[0];

    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': csrf_token }
    });
    $.ajax({
        url: window.location.origin + '/protocol/' + protocolId + '/' + action,
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
// Hide Modal
function hideChangeStatusModal() {
    changeStatusModal.classList.add('hidden');
    changeStatusModal.getElementsByClassName('modal-message')[0].innerText = '';
    hideInitialMessages();
}
// Hide modal's initial messages
function hideInitialMessages(){
    let cancelMsg = changeStatusModal.getElementsByClassName('cancel-message')[0];
    let reactivateMsg = changeStatusModal.getElementsByClassName('reactivation-message')[0];

    if (!cancelMsg.classList.contains('hidden')){
        cancelMsg.classList.add('hidden');
    }
    if (!reactivateMsg.classList.contains('hidden')){
        reactivateMsg.classList.add('hidden');
    }
}
// Show Modal
function showChangeStatusModal() {
    changeStatusModal.classList.remove('hidden');
}