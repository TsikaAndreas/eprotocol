$(document).ready(function() {
    let addButton = document.getElementById("addFileButton");
    if (addButton !== null) {
        addButton.addEventListener("click", addNewFileInput);
    }

    let deleteFileModal = $('#deleteFileModal');
    let closeDeleteFileModal = deleteFileModal.find('.modal-close');
    if (closeDeleteFileModal.length !== 0){
        closeDeleteFileModal.click(hideDeleteFileModal);
    }
    let cancelDeleteFileModal = deleteFileModal.find('.modal-cancel');
    if (cancelDeleteFileModal.length !== 0){
        cancelDeleteFileModal.click(hideDeleteFileModal);
    }
});

function addNewFileInput(){
    let section = document.getElementById('protocol_files');
    let form_section = section.getElementsByClassName('form-section')[0];
    let form_group = form_section.getElementsByClassName('form-group')[0];

    let label = document.createElement('label');
    label.htmlFor = 'file';
    label.className = 'custom-label';
    label.innerText = 'Επιλέξτε αρχείο:';
    form_group.appendChild(label);

    let div = document.createElement('div');
    div.className = 'flex';
    label.appendChild(div);

    let input = document.createElement('input');
    input.type = 'file';
    input.name = 'file[]';
    input.placeholder = 'Επιλέξτε αρχείο';
    input.className = 'block mt-1';
    div.appendChild(input);

    let icon = document.createElement('i');
    icon.className = 'tempFile custom-delete-2 fas fa-times fa-lg';
    icon.title = 'Click to delete';
    div.appendChild(icon);

    removeTemporaryFile();
}

function removeTemporaryFile() {
    $('.tempFile').off('click').click(function () {
        this.parentElement.parentElement.remove()
    });
}

var deleteFileModal = document.getElementById('deleteFileModal');

// Get all uploaded files and check's if the delete icons is clicked
let uploadedFiles = $('.uploaded-file');
if (uploadedFiles.length !== 0) {
    uploadedFiles.off('click').click(function () {
        deleteFile(this);
    });
}

// Prepare the data for the modal & show's it
function deleteFile(element) {
    let protocol = String(element.getAttribute('data-protocol'));
    let file = String(element.getAttribute('data-file'));
    let child = element.parentElement.getElementsByClassName('download-file')[0];
    let fileName = child.lastChild.nodeValue.trim();

    deleteFileModal.getElementsByClassName('delete-message')[0].classList.remove('hidden');
    deleteFileModal.getElementsByClassName('modal-message')[0].innerHTML =
        'File: <span class="text-indigo-700">' + fileName + '</span>';
    let submitBtn = deleteFileModal.getElementsByClassName('modal-submit')[0];
    submitBtn.setAttribute('onclick','deleteFileAjax(' + protocol + ',' + file + ')');
    showDeleteFileModal();
}
// show the modal
function showDeleteFileModal() {
    deleteFileModal.classList.remove('hidden');
}
// hide the modal
function hideDeleteFileModal() {
    deleteFileModal.classList.add('hidden');
}
// hides the initial message of the modal
function hideDeleteInitialMessages() {
    let deleteMsg = deleteFileModal.getElementsByClassName('delete-message')[0];
    if (!deleteMsg.classList.contains('hidden')){
        deleteMsg.classList.add('hidden');
    }
}
// ajax request for file deletion
deleteFileAjax = function (protocol,file,fileName) {
    let deleteFileMsg = deleteFileModal.getElementsByClassName('modal-message')[0];
    let csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajaxSetup({
        headers:
            { 'X-CSRF-TOKEN': csrf_token }
    });
    $.ajax({
        url: window.location.origin + '/deletefile/' + protocol + '/' + file,
        method: "post",
        dataType: "json",
        data: {
            protocol_id: protocol,
            file_id: file
        }
    }).done( function (result) {
        hideDeleteInitialMessages();
        if (result.success) {
            deleteFileMsg.innerHTML = '<p class="text-green-500">' + result.message + '</p>';
            removeDeletedFile(protocol,file);
        } else if (result.error) {
            deleteFileMsg.innerHTML = '<p class="text-red-500">' + result.message + '</p>';
        }

    }).fail( function (result) {
        hideDeleteInitialMessages();
        deleteFileMsg.innerHTML = '<p class="text-red-500">' + result.statusText + '</p>';
        deleteFileMsg.innerHTML += '<p>' + result.responseText + '</p>';
    });
}
// Remove the file from the front if its deleted
function removeDeletedFile(protocol,file) {
    let element = $(".uploaded-file[data-file='" + file + "'][data-protocol='"+ protocol +"']")[0];
    if (element !== undefined) {
        element.parentElement.remove();
    }
}

