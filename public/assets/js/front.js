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

    // Fonction de vérification des mots de passe
    function check() {
        var pwd = $("#password").val();
        var pwd2 = $("#password2").val();

        if (pwd2 !== pwd) {
            $("#password2").css("border", "3px solid red");
            $("#password2").effect("shake", {distance: 5, direction: "up"});
            return true;
        } else {
            $("#password2").css("border", "none");
            return false;
        }
    }

    // Fait le check sur le formulaire d'inscription
    $("#signup").submit(function (event) {
        if (check() === true) {
            event.preventDefault();
            alert("Les mots de passe doivent être identiques !");
        }
    });

    // Fait le check sur le formulaire de changement mot de passe
    $("#changepwd").submit(function (event) {
        if (check() === true) {
            event.preventDefault();
            alert("Les mots de passe doivent être identiques !");
        }
    });
    
}); // FIN JQUERY !!!!!