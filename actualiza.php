<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trivago is here?</title>
    
    <link rel="stylesheet" href="css/styles.css">
    <link href="images/favicon.ico" rel="icon" type="image/x-icon" />
    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

    <div id="wrapper">

        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Trivago v2.0</a>
            </div>


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">

                        <li>
                            <a href="index.php"><i class="fa fa-question fa-fw"></i> Trivago is here</a>
                        </li>
                        <li>
                            <a href="index.php#estadisticas"><i class="fa fa-bar-chart-o fa-fw"></i> Asistencia mensual</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bell fa-fw"></i> Aviso de entrada/salida<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="actualiza.php?ishere=yes&mypass=trivagomola"><i class="fa fa-thumbs-o-up fa-fw"></i> Trivago ha venido</a>
                                </li>
                                <li>
                                    <a href="actualiza.php?ishere=no&mypass=trivagomola"><i class="fa fa-thumbs-o-down fa-fw"></i> Trivago se fue</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
<?php 

//$estado = "yes";
//$pass = "trivagomola";
$estado = $_GET["ishere"];

$pass = $_GET["mypass"];

if($pass == "trivagomola"){

	if ($estado == "yes"){
           
            $file = fopen("data/ishere", "w");
            fwrite($file, "yes" . PHP_EOL);
            fclose($file);
            
            
            $registro= "[". date("d") . "-" . date("m") . "-" . date("Y"). "]".PHP_EOL;
            $mes = date("n");
            $fichero = "data/fechas";

            $filas = file($fichero);
            $num_ultima = count($filas) - 1; 
            $ultima_linea = $filas[$num_ultima];
         
		 if ($registro == $ultima_linea){
                echo "<h1 class='coloranimation'>Ya se ha actualizado la excel una vez, no quieras enfadar a la bestia.</h1><hr />";
            }else{ 
                  $fileReg = fopen("data/fechas", "a");
                fwrite($fileReg, $registro);
                fclose($fileReg);
                $contenidoJson = file_get_contents("data/months.json");
                $yearArray = json_decode($contenidoJson, true);
        
                $yearArray["year"]["months"][$mes]["cantidad"] += 1;
                
                $json_string = json_encode($yearArray);
                $file = 'data/months.json';
                file_put_contents($file, $json_string);
                
                
                $fileReg = fopen("data/fechas", "a");
                fwrite($fileReg, $registro);
                fclose($fileReg);
                echo "<h1 class='coloranimation'>Trivago ha venido :) Se actualiza la excel</h1><hr />";
            }
		
	}else if ($estado == "no"){
            
            $file = fopen("data/ishere", "w");
            fwrite($file, "no" . PHP_EOL);
            fclose($file);
      
                echo "<h1 class='coloranimation'>Oh no!!! Trivago nos deja, nadie sabe cuando volver&aacute;.... :(</h1><hr />";
	}else{
		echo "<h1 class='coloranimation'>Error!!, algo estas toquiteando y la bestia te castigar&aacute;</h1><hr />";
	}
	
	
}else{
	echo "<h1 class=''>Contraseña incorrecta!! Estas enfadando a la bestia... </h1><hr>";
}
?>

                    </div>
            </div>
    </div>
</div>
    <?php include_once("analyticstracking.php") ?>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2-dist.js"></script>
   
</body>

</html>
