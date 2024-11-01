<?php 
session_start(); // Iniciamos la sesión 
?> 
<!DOCTYPE html PUBLIC> 
<head> 
<meta charset="UTF-8" /> 
<title>Ejemplo Captcha</title> 
</head> 
<body> 
<?php 
$numero1= rand(0,9); 
$numero2= rand(0,9); 
$numero3= rand(0,9); 
$minus = array("a","b","c","d","e","f","g","h","i","j","k","l","m","n","ñ","o","p","q","r","s","t","u","v", "w","x","y","z"); 
$mayus = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","Ñ","O","P","Q","R","S","T","U ","V","W","X","Y","Z"); 
$signos = array("!","#","$","%","&","="); 
$generador_min = rand(0,26); 
$generador_may = rand(0,26); 
$generador_sig = rand(0,5); 
$_SESSION["codigos"] = ($numero1).($minus[$generador_min]).($numero2).($mayus[$generador_may]).($signos[$generador_sig]).($numero3);  
// Guardamos el texto del CAPTCHA en la session 
print "<img src=imagen2.php alt=CAPTCHA>"; 
?> 
<form id="pruebaCaptcha" action="confirmacion2.php" method="post"> Escriba codigo de seguridad: 
<label> 
<input name="confirmacion" type="text" id="confirmacion" /> 
</label> 
<p> 
<label> 
<input type="submit" id="comprobar" value="Comprobar" /> 
</label> 
</p> 
</form> 
</body> 

<script src="https://www.google.com/recaptcha/api.js?render=6Le4Z2wqAAAAAMxTkOJWkBA9D7KmVIC_XSUqIpaG"></script>

<script>
    $(document).ready(funtion(){

        $("#comprobar")

    })
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Le4Z2wqAAAAAMxTkOJWkBA9D7KmVIC_XSUqIpaG', {action: 'submit'}).then(function(token) {
              // Add your logic to submit to your backend server here.
          });
        });
      }
  </script>

</html> 
