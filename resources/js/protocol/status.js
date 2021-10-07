$(document).ready(function() {
    let protocolReactivateBtn = document.getElementById('reactivateProtocol');
    let protocolCancelBtn = document.getElementById('cancelProtocol');

    if (protocolReactivateBtn !== null) {
        protocolReactivateBtn.addEventListener('click',reactivateProtocol);
    }
    if (protocolCancelBtn !== null) {
        protocolCancelBtn.addEventListener('click',cancelProtocol);
    }
});

function cancelProtocol() {
    let protocol = {
        id: document.getElementById('cancelProtocol').value,
        name: document.getElementById('protocol').textContent,
        action: 'cancel'
    }
    protocolStatusChange('Cancellation', protocol);
}

function reactivateProtocol() {
    let protocol = {
        id: document.getElementById('reactivateProtocol').value,
        name: document.getElementById('protocol').textContent,
        action: 'reactivate'
    }
    protocolStatusChange('Reactivation', protocol);
}

function protocolStatusChange(action, protocol) {
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    Swal.fire({
        html: '<p>Please confirm the <b>'+ action +'</b> of the following protocol.</p><p><b>' + protocol.name + '</b></p>',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#10b981',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirm',
        showLoaderOnConfirm: true,
    }).then(function (e) {
        if (e.isConfirmed) {
            $.ajax({
                url: window.location.origin + '/protocol/change-status',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    _token: CSRF_TOKEN,
                    id: protocol.id,
                    action: protocol.action
                },
                success: function (results) {
                    if (results.success === true) {
                        Swal.fire('', results.message, "success").then(function (target) {
                            if (target.isConfirmed || target.isDismissed) {
                                window.location.reload();
                            }
                        });
                    } else {
                        Swal.fire('', results.message, "warning").then(function (target) {
                            if (target.isConfirmed || target.isDismissed) {
                                window.location.reload();
                            }
                        });
                    }
                },
                fail: function (results) {
                    Swal.fire('', results.message, "error");
                }
            });
        }
    });
}
