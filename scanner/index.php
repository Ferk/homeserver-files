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
  </script>
</head>
<h1>Scanner</h1>
  
<form action="." method="post" id="controls">
  <label for="resolution">Resolución: <span id="res-display">100</span>%</label>
  <input name="resolution" type="range" required="true" min="30" max="300" value="100" onchange="printid('res-display',this.value);"/>
  <br/><input type="submit" class="submit" value="Escanear" 
        onclick='printid("info","<h2>Escaneando...</h2> <p>Espera mientras el scanner termina de realizar el barrido.</p><p>El tiempo de espera será mayor si la resolución es alta.</p>");this.parentElement.style.display="none";'/>
</form>
  
<div id="info">
  <?php if( isset($_POST["resolution"]) ): ?>
  <h2>Resultado del escaneado</h2>
  <p>A continuación se muestra la imagen resultado del escaneado realizado bajo resolución <?php echo $_POST["resolution"]?>.</p>
  <p>Para descargarla, haz click derecho sobre ella y elige "Guardar imagen como..".</p>
  
  <?php
  //echo "./scanner ".$_GET["res"]."<br/>";
  $fname= exec("./scan.sh ".$_POST["resolution"]);
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
