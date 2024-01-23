// **script created and edited
// for Enock Ramos thanks to free
// documentation to Jquery(JavaScript)
$(document).ready(function () {
    $(window).resize(function () {
        rowToggler();
    });

    rowToggler();
    Tables();

    function rowToggler() {
        var windowSize = window.screen.availWidth;
        var $research = $('.research');
        $research.find("tr").not('.accordion').hide();
        $research.find("tr").eq(0).show();
        $research.find(".accordion").click(function(){
            if($(window).width() <= 760){
                $(this).next("tr").toggle("slow");
                $(".tog").toggle("slow");
            }
        })
        if(windowSize < 760){
             $(".tog").hide();$(".notog").hide();$("#lol1").hide();$("#lol").show();
        }else{
            $(".tog").show();$(".notog").show();$("#lol1").show();$("#lol").hide();
        }
    };
    function Tables(){
    $( "#TableBusqueda" ).show(function() {
        $("#TableConsultas").hide();
        $("#p").hide();
        $("#lol1").hide();
        $("#lol").hide();
    });
}
});

$("#oplmb").click(function(event) {
    $("#oplm")[0].reset();
});