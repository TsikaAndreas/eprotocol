$(document).ready(function() {

    var addButton = document.getElementById("addFileButton");
    if (addButton !== null) {
        addButton.addEventListener("click", addNewFileInput);
    }
});

function addNewFileInput(){
    var section = document.getElementById('protocol_files');
    var form_section = section.getElementsByClassName('form-section')[0];
    var form_group = form_section.getElementsByClassName('form-group')[0];

    var label = document.createElement('label');
    label.id = 'description';
    label.className = 'custom-label';
    label.innerText = 'Επιλέξτε αρχείο:';

    form_group.appendChild(label);

    var input = document.createElement('input');
    input.type = 'file';
    input.name = 'file[]';
    input.placeholder = 'Επιλέξτε αρχείο';
    input.className = 'block mt-1';

    label.appendChild(input);
}