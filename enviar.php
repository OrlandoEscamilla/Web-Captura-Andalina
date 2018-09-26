<?php
//Como el elemento es un arreglos utilizamos foreach para extraer todos los valores

$peso = 0;
	foreach($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
	{
		//Validamos que el archivo exista
		if($_FILES["archivo"]["name"][$key]) {
			$filename = $_FILES["archivo"]["name"][$key]; //Obtenemos el nombre original del archivo
			$source = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos un nombre temporal del archivo

			$peso = $peso + $_FILES["archivo"]["size"][$key];



			$fecha = getdate();
		  $fechas = $fecha['mday'].$fecha['mon'].$fecha['year'].$fecha['hours'].$fecha['minutes'].$fecha['seconds'];
			$directorio = 'docs/'.$fechas; //Declaramos un  variable con la ruta donde guardaremos los archivos

			//Validamos si la ruta de destino existe, en caso de no existir la creamos
			if(!file_exists($directorio)){
				mkdir($directorio, 0777) or die("No se puede crear el directorio de extracci&oacute;n");
			}

			$dir=opendir($directorio); //Abrimos el directorio de destino
			$target_path = $directorio.'/'.$filename; //Indicamos la ruta de destino, así como el nombre del archivo

			//Movemos y validamos que el archivo se haya cargado correctamente
			//El primer campo es el origen y el segundo el destino
			if(move_uploaded_file($source, $target_path)) {

				//echo "El archivo $filename se ha almacenado en forma exitosa.<br>";
				} else {
				echo "Ha ocurrido un error, por favor inténtelo de nuevo.<br>";
			}
			closedir($dir); //Cerramos el directorio de destino
		}
		if ($peso > 64000000){
			echo '
 			<script type="text/javascript">
 				alert("Sus archivos superan los 60mb porvafor verifique el peso de sus archivos");
 				window.location = "index.html";
 		 </script>';
		}
	}




	require('inc/PHPMailer-master/PHPMailerAutoload.php');


	$evento = $_POST['evento'];
	$fecha = $_POST['fecha'];
	$weddingf = $_POST['weddingf'];
	$weddingi = $_POST['weddingi'];
	$decoracionf = $_POST['decoracionf'];
	$decoracioni = $_POST['decoracioni'];
	$musicaf = $_POST['musicaf'];
	$musicai = $_POST['musicai'];


	$ruta = "http://centralandalina.com/central_form/".$directorio;




	$mail = new PHPMailer;



	$mail->isSMTP();

	$mail->Host = 'smtp.gmail.com';

	$mail->SMTPAuth = true;

	$mail->Username = "centralandalinacontacto@gmail.com";

	$mail->Password = "allyouneedisamor";

	$mail->SMTPSecure = 'tls';

	$mail->Port = 587;





	$mail->setFrom('centralandalinacontacto@gmail.com');

	$mail->addAddress('azcarraga.r@gmail.com');
	$mail->AddAddress('armando@cualti.edu.mx');
  	$mail->AddAddress('vanesa@cualti.edu.mx');
  	

	$mail->Subject = 'Contacto desde la web';

	$mail->Body = "Nombre del evento: ".$evento."\r\nFecha del evento: ".$fecha."\r\nWedding planner facebook: ".$weddingf."\r\nWedding planner instagram: ".$weddingi."\r\nDecoracion usuario de fecebook: ".$decoracionf."\r\nDecoracion usuario de instagram: ".$decoracioni."\r\nMusica usuario de facebook: ".$musicaf."\r\nMusica usuario de instagram: ".$musicai."\r\nRuta: ".$ruta;





if ($mail->send()) {

           echo '
           	<script type="text/javascript">
           		alert("Informacion enviada con exito");
							window.location = "index.html";
           </script>';


	}
	else{
		 echo '
           	<script type="text/javascript">
           		alert("La informacion no se pudio enviar, intentelo mas tarde");
							window.location = "index.html";
           </script>';
}





?>
