$(document).ready(function(){
    
        $("#selCat").change(function(){
		console.log($("#selCat").val());
		window.location.href="http://localhost/wikiwebdev/public/terms/"+$("#selCat").val()+"/";
        });
    
}); //FIN JQUERY !!!!!