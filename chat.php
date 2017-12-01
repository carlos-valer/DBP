<?php
	session_start();

	if(!isset($_SESSION["usuario"]))
		header('Location: inicio.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>chat</title>
    <link rel="stylesheet" href="css/chat.css">
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script>
            var id_usuario = "<?php echo $_SESSION["id"]; ?>";
            var usuario = "<?php echo $_SESSION["usuario"]; ?>";

            function cargarInfoInicial(){
                jQuery(".nombre_u").html(usuario);
                cargarContactos();
            }

            function cargarContactos(){
			jQuery.ajax({method: "GET", url: "lista_contactos.php", dataType: 'text'}).done(function( responseText ) {
                
                var json = JSON.parse(responseText);
                var html = "";
                for (var i=0; i<json.length; i++) {
                    html += "<div class=\"id_contacto\" onclick='datosContacto(\""+json[i].id + "\",\"" + json[i].usuario +"\")'>";
                    html += "<div class='imagen_contacto'><img class='avatar' id='avatar_contacto' src='img/avatar2.png'></div>";
                    html += "<div class=\"nombre\">" + json[i].usuario + "</div>";
                    
                    if(json[i].conexion == 0)
                    	html += "<div class='conexion_off'></div>";                    
                    else
                    	html += "<div class='conexion_on'></div>";
                    html += "</div>";
                }
                jQuery("#contenedor_contactos").html(html);
                });
	    	}

            function datosContacto(id, usuario_contacto){
                jQuery(".nombre_c").html(usuario_contacto);
                $(".nombre_c").attr("id",id);
                cargarMensajes(id);
            }
            function cargarMensajes(id_contacto){
                var id = {
                    "id_contacto": id_contacto
                };

                jQuery.ajax({method: "POST", url: "cargar_mensajes.php", data: JSON.stringify(id), dataType: 'text'}).done(function( responseText ) {
                        var json = JSON.parse(responseText);
                        var html = "";
                        
                        for (var i=0; i<json.length; i++) {
                            var dir;
                            var color;
                            if(json[i].id_emisor == id_usuario){
                                dir = "right";
                                color = "blue";
                            }
                            else{
                                dir = "left";
                                color = "black"
                            }
                            
                            html += "<p style=\"color:"+ color +";text-align:" + dir + "\">" + json[i].mensaje + "<sub style=\"color:silver\">" + json[i].fecha + "</sub></p>";
                        }
                        jQuery("#contenedor_sms").html(html);
                });
            }

            function guardarMensaje(){
                var id_receptor = jQuery(".nombre_c").attr("id");
                if(jQuery("#enviar_mensaje").val() == ''){}
                else{
                var dato = {
                    "mensaje" : jQuery("#enviar_mensaje").val(),
                    "id_receptor" : id_receptor
                };

                jQuery.ajax({method: "POST", url: "guardar_mensaje.php", data: JSON.stringify(dato), dataType: 'text'}).done(function( responseText ) {
                        window.setInterval("cargarMensajes("+id_receptor+")",10);
                });
                
                document.getElementById("enviar_mensaje").value = "";
                }
            }
            function buscarUsuario(){
                var dato = {
                    "sms": jQuery("#buscar").val()
                };

                jQuery.ajax({method: "POST", url: "buscar_usuario.php", data: JSON.stringify(dato), dataType: 'text'}).done(function( responseText ) {
                        var json = JSON.parse(responseText);
                        var html = "";
                    
                        for (var i=0; i<json.length; i++) {
                            html += "<div class='lista' id='" + json[i].id + "'>"
                            html += "<div class='nom'>" + json[i].email + "</div>";
                            html += "<div class='opc'>";
                            if(json[i].contacto == '1'){
                                html += "<a href='#' onclick='borrarContacto(\""+ json[i].id +"\")'><img id=\"btn_eliminar\" src=\"img/borrar.png\" ></a>";    
                            }
                            else{
                                html += "<a href='#' onclick='agregarContacto(\""+ json[i].id +"\")'><img id=\"btn_agregar\" src=\"img/agregar.png\" ></a>";
                            }
                            html += "</div></div>";
                        }
                        document.getElementById("buscar").value = "";
                        jQuery("#resultado_busqueda").html(html);
                });
            }
            function borrarContacto(id_contacto){
                
                var id = {
                    "id_contacto": id_contacto
                };

                jQuery.ajax({method: "POST", url: "borrar_contacto.php", data: JSON.stringify(id), dataType: 'text'}).done(function( responseText ) {
                    alert(responseText);
                });
            }

            function agregarContacto(id_contacto){
                
                var id = {
                    "id_contacto": id_contacto
                };

                jQuery.ajax({method: "POST", url: "agregar_contacto.php", data: JSON.stringify(id), dataType: 'text'}).done(function( responseText ) {
                    alert(responseText);
                });

            }

        </script>

     
</head>

<body onload="cargarInfoInicial()">
    <div id="ventana">



        <div id="contacto">
            <header id="dato_contacto">
                <div id="nombre_contacto">
                    <div class="imagen_avatar"><img class="avatar" id="avatar_contacto" src="img/avatar2.png"></div>
                    <div class="nombre_c"></div>
                </div>
                
            </header>

            <div id="contenedor_sms"></div>
            
            <footer id="sms_form">
                <form action="" method="">
					<input id="enviar_mensaje" type="text" name="mensaje" placeholder="Escribe tu mensaje" autocomplete="off" required>
					<a href="#" onclick="guardarMensaje()"><img id="enviar" src="img/enviar.png" ></a>
				</form>
            </footer>
        </div>





        <div id="usuario">
            <header id="dato_usuario">
                <div id="nombre_usuario">
                    <div class="imagen_avatar"><img class="avatar" id="avatar_ususario" src="img/avatar2.png"></div>
                    <div class="nombre_u"></div>
                </div>
                <div id="opc_usuario">
                <a href="fin_sesion.php" ><img id="btn_salir" src="img/cerrar.png" ></a>
                </div>
            </header>

            <div id="contenedor_contactos"></div>

            <div id="buscador">
                
                    <input type="text" name="buscar" id="buscar" placeholder="busque contacto">
                    <a href="#" onclick="buscarUsuario()"><img id="btn_buscar" src="img/buscar.png" ></a>
                
                <div id="resultado_busqueda"></div>

            </div>


            
        </div>




    </div>    
</body>
</html>