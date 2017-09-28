<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
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

<body onload="checkTrivago()">
	<audio loop autoplay src="trivago.mp3">Tu navegador no soporta HTML5</audio>
    <div id="wrapper">

        <!-- Navigation -->
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
                            <a href="#estadisticas"><i class="fa fa-bar-chart-o fa-fw"></i> Asistencia mensual</a>
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
                    <h1 class="coloranimation" id ="headerMsg">#</h1>
                    <hr>
                </div>
            </div>
             <div class="row">
                <div class="col-lg-12">
                  <div class="panel panel-default">
                       <div class="panel-body">
                  	         <img id ="trivagoImg" class="img-responsive" src="#"/>
                        </div>
                 </div>
               </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Asistencia mensual Trivago
                        </div>
                        <div class="panel-body" id="estadisticas">
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                   
                </div>
            </div>
    </div>
</div>
		<?php include_once("analyticstracking.php") ?>
        <script>
			
			loadJSON = function(path, success, error) {
				var xhr = new XMLHttpRequest();
				xhr.onreadystatechange = function() {
					if (xhr.readyState === XMLHttpRequest.DONE) {
						if (xhr.status === 200) {
							if (success)
								success(JSON.parse(xhr.responseText));
						} else {
							if (error)
								error(xhr);
						}
					}
				};
				xhr.open("GET", path, true);
				xhr.send();
			};
            
            
            
			
			checkTrivago = function() {	
                var rawFile = new XMLHttpRequest();
				rawFile.open("GET", "data/ishere", false);
				rawFile.onreadystatechange = function () {
					if (rawFile.readyState === 4) {
						if (rawFile.status === 200 || rawFile.status == 0) {
							var text = rawFile.responseText.trim();
							if (text.toString() == 'yes') {
								document.getElementById("headerMsg").innerHTML = "Baby I'm here!";
								document.getElementById("trivagoImg").src = "images/ishere.jpg";
							} else {
								document.getElementById("headerMsg").innerHTML = "Sorry, I'm out...";
								document.getElementById("trivagoImg").src = "images/isnothere.jpg";
							}
						}
					}
				}
				rawFile.send(null);
							
				loadJSON('data/months.json', function(jsondata) {
				
                    var cantidades = new Array();
					var monthNames = new Array();
                    
					var months = jsondata.year.months;
                        
                    var year = jsondata.year.id;
        
                    for (var i = 1; i < 12; ++i) {
						var mes = months[i];
                        
					    cantidades.push(mes.cantidad);
                        monthNames.push(mes.id);
					}
					
					var config = {
						type: 'bar',
						data: {
							labels: monthNames,
							datasets: [{
								label: year,
								data: cantidades,
								backgroundColor: [    'rgba(255, 99, 132, 0.2)',
                                                      'rgba(54, 162, 235, 0.2)',
                                                      'rgba(255, 206, 86, 0.2)',
                                                      'rgba(75, 192, 192, 0.2)',
                                                      'rgba(153, 102, 255, 0.2)',
                                                      'rgba(255, 159, 64, 0.2)',
                                                 'rgba(215, 123, 134, 0.2)',
                                                 'rgba(215, 214, 134, 0.2)',
                                                 'rgba(91, 0, 134, 0.2)',
                                                 'rgba(255, 158, 70, 0.2)',
                                                 ' rgba(115, 77, 70, 0.2)',
                                                 'rgba(115, 156, 70, 0.2)'],
								borderColor: ['rgba(255,99,132,1)',
                                                'rgba(54, 162, 235, 1)',
                                                'rgba(255, 206, 86, 1)',
                                                'rgba(75, 192, 192, 1)',
                                                'rgba(153, 102, 255, 1)',
                                                'rgba(255, 159, 64, 1)',
                                             'rgba(215, 123, 134, 1)',
                                             'rgba(215, 214, 134, 1)',
                                              'rgba(91, 0, 134, 1)',
                                             'rgba(255, 158, 70, 1)',
                                             ' rgba(115, 77, 70, 1)',
                                             'rgba(115, 156, 70, 1)'],
								borderWidth: 1
							}]
						},
						options: {
							scales: {
								yAxes: [{
								  ticks: {
									beginAtZero: true,
								  }
								}]
							}
						}
					};
					
					var ctx = document.getElementById("canvas").getContext("2d");
					window.myLine = new Chart(ctx, config);
					
				}, function(xhr) { alert(xhr); });
			
			};

		</script>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <!--<script src="vendor/raphael/raphael.min.js"></script>-->
    <!-- <script src="vendor/morrisjs/morris.min.js"></script>-->
    <!--<script src="data/morris-data.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2-dist.js"></script>

    <!-- Navarro Library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
	<script src="http://www.chartjs.org/dist/2.6.0/Chart.js"></script>
	<script src="http://www.chartjs.org/samples/latest/utils.js"></script>
    
    
</body>

</html>
