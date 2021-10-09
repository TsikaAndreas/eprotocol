$(document).ready(function() {
    let addButton = document.getElementById("addFileButton");
    if (addButton !== null) {
        addButton.addEventListener("click", addNewFileInput);
    }
});

function addNewFileInput(){
    let section = document.getElementById('protocol_files');
    let form_section = section.getElementsByClassName('form-section')[0];
    let form_group = form_section.getElementsByClassName('form-group')[0];

    let label = document.createElement('label');
    label.htmlFor = 'file';
    label.className = 'custom-label';
    form_group.appendChild(label);

    let div = document.createElement('div');
    div.className = 'flex';
    label.appendChild(div);

    let input = document.createElement('input');
    input.type = 'file';
    input.name = 'file[]';
    input.placeholder = 'Select File';
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

    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    Swal.fire({
        html: '<p>Are you sure you want to delete the following file?</p><p><b>'+ fileName + '</b></p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        showLoaderOnConfirm: true,
    }).then(function (e) {
        if (e.isConfirmed) {
            $.ajax({
                url: window.location.origin + '/deletefile/' + protocol + '/' + file,
                method: "post",
                dataType: "json",
                data: {
                    _token: CSRF_TOKEN,
                    protocol_id: protocol,
                    file_id: file
                },
                success: function (results) {
                    if (results.success) {
                        Swal.fire('', results.message, "success");
                        removeDeletedFile(protocol,file);
                    } else {
                        Swal.fire('Error!', results.message, "error");
                    }
                },
                fail: function (results) {
                    Swal.fire('Error!', results.message, "error");
                }
            });
        }
    });

}
// Remove the file from the front if its deleted
function removeDeletedFile(protocol,file) {
    let element = $(".uploaded-file[data-file='" + file + "'][data-protocol='"+ protocol +"']")[0];
    if (element !== undefined) {
        element.parentElement.remove();
    }
}
