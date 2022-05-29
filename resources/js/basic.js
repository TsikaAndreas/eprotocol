$(document).ready(function () {
    // Sidebar
    $(".hamburger .fas").click(function(){
        $(".page_wrapper").addClass("active")
    })

    $(".page_wrapper .sidebar .close").click(function(){
        $(".page_wrapper").removeClass("active")
    })

    // Global Search
    $('#globalSearch').keyup(function (e) {
        if (e.keyCode === 13){
            SearchAjax(this.value);
        }
    });
    $('.search .fas').click( function () {
        let value = $('#globalSearch').val();
        SearchAjax(value);
    });

    function SearchAjax(keyword) {
        let protocol_url = '/protocol/';
        keyword = keyword.trim();
        if (keyword.length < 3){
            let message = '<div class="search-error">Search value must contain at least 3 characters.</div>';
            let list = $('.search-list');
            list.find('.list-items').html(message);
            list.show();
            return true;
        }
        $('.search-list .list-items').html('<img width="50" height="50" src="../assets/gifs/loading.gif" />');
        $('.search-list').show();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/global-search',
            method: "get",
            dataType: "json",
            data: {
                keyword: keyword,
            }
        }).done( function (result) {
            let html = '<hr><div class="total-items"><b>' + result.total + '</b><span> items have been found!</span></div><hr>';
            if (result.total !== 0) {
                result.data.forEach(function (item) {
                    let date = new Date(item.created_at);
                    html += '<li>' +
                        '<div class="item-protocol"><a target="_blank" href="' + protocol_url + item.id + '">' + item.protocol + '</a>' +
                        '<span><b>Created:</b> ' + date.getFullYear() + '-' + Number(date.getMonth() + 1) + '-' + date.getDate() + '</span></div>' +
                        '<div class="item-creator"><b>Creator:</b> ' + item.creator + '</div>' +
                        '<div class="item-receiver"><b>Receiver:</b> ' + item.receiver + '</div>';
                    if (item.incoming_protocol !== null) {
                        html += '<div class="item-incoming"><b>incoming Protocol:</b> ' + item.incoming_protocol + '</div></li><hr>';
                    } else {
                        html += '</li><hr>';
                    }
                });
            }
            $('.search-list .list-items').html(html);
            $('.search-list').show();
        }).fail( function (result) {
            $('.search-list .list-items').html(
                '<div class="search-error">An unexpected error has been occurred!</div>'
            );
            $('.search-list').show();
        });
    }

    // Show/Hide Password
    document.querySelectorAll('.active-eye').forEach(item => {
        item.addEventListener('click', event => {
            let sibling = event.target.previousElementSibling;
            if (sibling.getAttribute('type') === 'password'){
                sibling.setAttribute('type','text');
                event.target.classList.remove('fa-eye-slash');
                event.target.classList.add('fa-eye');
            } else {
                sibling.setAttribute('type','password');
                event.target.classList.remove('fa-eye');
                event.target.classList.add('fa-eye-slash');
            }
        })
    })

    // Remove alert
    let alert = $('div[role="alert"]').find('.close-alert');
    if (alert.length > 0) {
        alert.on('click', function (event) {
            event.target.closest('div[role="alert"]').remove();
        });
    }
});

$(document).mouseup(function(e)
{
    var container = $(".search-list");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        container.hide();
    }
});
