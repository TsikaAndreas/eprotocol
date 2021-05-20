$(document).ready(function () {
    $(".hamburger .fas").click(function(){
        $(".page_wrapper").addClass("active")
    })

    $(".page_wrapper .sidebar .close").click(function(){
        $(".page_wrapper").removeClass("active")
    })
});
