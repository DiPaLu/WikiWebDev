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

    /* l'appel AJAX pour valider un terme*/
    /*
    $("#button-validate-term").click(function () {
        $.ajax({
            url: 'ajax.php',
            datatype: 'json',
            method: 'post',
            cache: false,
            data: {
                status: 'Validated'
            }
        }).done(function (data) {
            alert('ajax terminé: accepter terme');
            //debug(data);
        });

    });
*/
    /* l'appel AJAX pour refuser un terme*/
/*
    $("#button-refuse-term").click(function () {
        $.ajax({
            url: 'ajax.php',
            datatype: 'json',
            method: 'post',
            cache: false,
            data: {
                status: 'Refused'
            }
        }).done(function () {
            alert('ajax terminé: refuser terme');
        });

    });
*/
    /* l'appel AJAX pour valider une définition*/
/*
    $("#button-validate-definition").click(function () {
        $.ajax({
            url: 'ajax.php',
            datatype: 'json',
            method: 'post',
            cache: false,
            data: {
                status: 'Validated'
            }
        }).done(function (data) {
            //alert('ajax terminé: valider définition');
            console.log(data);
        });

    });

    /* l'appel AJAX pour refuser une définition*/
/*
    $("#button-refuse-definition").click(function () {
        $.ajax({
            url: 'ajax.php',
            datatype: 'json',
            method: 'post',
            //cache: false,
            data: {
                status: 'Refused'
            }
        }).done(function () {
            alert('ajax terminé: refuser définition');
        });

    });
*/
    $("test-button").click(function () {
        $.ajax({
            url: "ajax.php",
            data: "",
            datatype: "text",
            
           success: function (strDate) {
                $('#show_date').text(strDate);
            }
        })

    });








}); // FIN JQUERY !!!!!