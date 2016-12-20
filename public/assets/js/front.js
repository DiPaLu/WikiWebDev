$(document).ready(function () {
    $("#showpwd").change(function () {
        if ($(this).is(":checked")) {
            $("#password").attr("type", "text");
            $("#password2").attr("type", "text");
        } else {
            $("#password").attr("type", "password");
            $("#password2").attr("type", "password");
        }
    });
    
    $("#password").change(function(){
    var test = $("#password").val();
    console.log(test);
        
    });
}); // FIN JQUERY !!!!!