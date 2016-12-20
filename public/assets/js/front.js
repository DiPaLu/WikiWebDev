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
    
    /* l'appel AJAX pour valider un terme*/
    
    $("#button-validate-term").click(function(){
        $.ajax({
            url: 'ajax.php',
            datatype: 'json',
            method: 'post',
            cache: false,
            data: {
                status: 'Validated'
            }
            }).done(function(){
                alert('ajax terminé: accepter terme');
        });      
                
    });
    
    /* l'appel AJAX pour refuser un terme*/
    
    $("#button-refuse-term").click(function(){
        $.ajax({
            url: 'ajax.php',
            datatype: 'json',
            method: 'post',
            cache: false,
            data: {
                status: 'Validated'
            }
            }).done(function(){
                alert('ajax terminé: refuser terme');
        });      
                
    });
    
    /* l'appel AJAX pour valider une définition*/
    
    $("#button-validate-definition").click(function(){
        $.ajax({
            url: 'ajax.php',
            datatype: 'json',
            method: 'post',
            cache: false,
            data: {
                status: 'Validated'
            }
            }).done(function(){
                alert('ajax terminé: valider définition');
        });      
                
    });
    
    /* l'appel AJAX pour refuser une définition*/
    
    $("#button-refuse-definition").click(function(){
        $.ajax({
            url: 'ajax.php',
            datatype: 'json',
            method: 'post',
            cache: false,
            data: {
                status: 'Validated'
            }
            }).done(function(){
                alert('ajax terminé: refuser définition');
        });      
                
    });
   
        
    
    
    
}); // FIN JQUERY !!!!!