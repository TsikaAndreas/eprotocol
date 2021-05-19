$(document).ready(function () {

    $('#globalSearch').keyup(function (e) {
        if (e.keyCode === 13){
            SearchAjax(this.value);
        }
    });

    function SearchAjax(keyword) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: window.location.origin + '/global-search/' + keyword,
            method: "post",
            dataType: "json",
            data: {
                keyword: keyword,
            }
        }).done( function (result) {
            console.log(result);
        }).fail( function (result) {

        });
    }
});
