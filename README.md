# consumoApi
 Pasos a seguir para el correcto funcionamiento de la app web:

-- Lo primero que tenemos que hacer es descargar este repositorio. Podemos hacerlo directamente desde el boton "<>Code" y luego en Download ZIP.

--(TODOS los archivos necesarios van a estar dentro de la carpeta "2doParcial")--

--Seguramente necesitemos xampp o un algun otro software que facilite la instalación y configuración de un entorno de servidor web de manera local.

--Ya teniendo eso, deberiamos meter nuestra carpeta "2doparcial" con todos sus archivos dentro de la carpeta htdocs del xampp. En mi caso: "D:\XAMPP\htdocs".

--Antes de colocarla directamente dentro de "htdocs", para una correcta referencia y llamado de los archivos, por las dudas crear la carpeta "consumoApi" y dentro de esta tambien una llamada igual. Recien dentro de esta ultima meter la carpeta "2doparcial".

--Ejemplo de como quedaria la ruta: "D:\XAMPP\htdocs\consumoApi\consumoApi\2doparcial"--

--Una vez hecho esto, podemos abrir Xampp e iniciar "Apache" y "MySQL".

--Vamos a nuestro gestor de base de datos (en este caso MySQL) e importamos el archivo "gestion_usuarios.sql".

--Ya una vez todo inicie correctamente, vamos a abrir nuestro navegador y vamos a ir a la ruta: 
"http://localhost/consumoApi/consumoApi/2doparcial/registroUsuario.php" Aca vamos a poder registrarnos.

--Tambien desde esa direccion podemos movernos hacia el login y dentro del login podemos ir al apartado de restablecer contraseña.

--Por las dudas dejo esas rutas en caso de algun fallo:

Login: "http://localhost/consumoApi/consumoApi/2doparcial/loginUsuario.php"

Restablecer Contraseña: "http://localhost/consumoApi/consumoApi/2doparcial/restablecerFormulario.html"

--A la hora de registrarnos, nos van a mandar un mail al correo que hayamos puesto para que nuestro usuario pase de no estar verificado a si estarlo. El estar verificados nos va a habilitar el poder logearnos.

--Si estamos registrados en la base de datos, podemos solicitar restablecer nuestra contraseña desde la pantalla login, solicitando un mail con el link para cambiar nuestra contraseña vieja a una nueva.

--Este accionar realiza cambios en la base de datos, como dar un token nuevo y agregar una fecha de modificacion.

-------------------------------------------------------------------------------------------------------------

--Explicacion de que funcion cumple cada archivo:

La carpeta con archivos "PHPMailer" nos va a servir para enviar emails mediante php basicamente.

"conexion.php" = define la conexion entre la base de datos para que los demas archivos puedan interactuar con esta.

Los archivos con "Api" al final (loginApi.php, registroApi.php, restablecerApi.php) son los encargados de manejar la API en si y actuan como endpoints.

loginApi.php = logica del login.

loginUsuario.php = el formulario para el login.

registroApi.php = logica del registro.

registroUsuario.php = formulario del registro.

restablecerApi.php = logica para restablecer la contraseña.

restablecerFormulario.html = el formulario en donde se pone el mail para que te envie el link para restablecer la contraseña.

restablecerPass.php = formulario donde el usuario pone su nueva contraseña.

verificar.php = logica para las distintas verificaciones.

styles.css = todo lo que sea estilos para el apartado visual de la pagina.


                            -- Y si no me olvido de nada, eso seria todo! B) --

