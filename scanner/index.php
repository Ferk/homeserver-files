<html>

<body>

<head>
  <title>Scanner interface</title>
  <link rel="stylesheet" type="text/css" href="/style/default.css"/>
  <script>
function printid(id, content) {
  var e = document.getElementById(id);
  e.innerHTML= content;
 }
function scan() {
  window.location = ".?res="+document.getElementById("res").value;
  printid("controls","<h2>Escaneando<blink>...</blink></h2> <p>Espera mientras el scanner termina de realizar el barrido. El tiempo de espera será mayor si la resolución es alta.</p>");
}
  </script>
</head>
<h1>Scanner</h1>
  
<div id="controls">  
  <input type="button" onclick="scan();" value="Escanear"/>
  <input id="res" name="resolution percentage" type="range" required="true" min="30" max="300" value="100" onchange="printid('res-display',this.value);"/>
  Resolution: <span id="res-display">100</span>
</div>
  
  <div>
  <?php if( isset($_GET["res"]) ): ?>
  <h2>Resultado del escaneado</h2>
  <p>A continuación se muestra la imagen resultado del escaneado realizado.</p>
  <p>Para descargarla, haz click derecho sobre ella y elige "Guardar imagen como..".</p>
  
  <?php
  //echo "./scanner ".$_GET["res"]."<br/>";
  $fname= exec("./scan.sh ".$_GET["res"]);
  echo "<img src=\"".$fname."\"/>";
  ?>

  <?php else: ?>

<h2>Instrucciones para el escaneado</h2>
  <ol>
  <li>Asegurate que el scanner conectado a este servidor está encendido</li>
  <li>Coloca lo que deseas escanear en el escaner, fijandote que la orientación sea correcta (la esquina marcada con una flecha en el scanner se corresponde con la esquina superior izquierda de la hoja)</li>
  <li>Presiona en el botón "Escanear" de esta página web para iniciar el proceso de captura.</li>
     </ol>

     <?php endif; ?>
</div>
     
<div>
<h2>Escaneos anteriores:</h2>
<pre>
<?php echo shell_exec('for i in $(find *.png | tac); do echo "<a href=\"$i\">$i</a>";done  ');?>
</pre>
</div>

</body>
</html>
