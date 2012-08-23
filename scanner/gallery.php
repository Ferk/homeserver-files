<!DOCTYPE HTML>
<html>
  <head>
	<meta charset="utf-8" />
<!--
<meta name="viewport" content="device-width = 640, device-height = 480, user-scalable = no">
-->
  <title>Image Gallery</title>
	<style>
	body {
	  font-family: arial, serif;
#	  background-color:black;
#	  foreground-color:white;
	  }
	button {
	  font-size: 2em;
	  border:1px solid #A78B53;
	}
	.active { background-color: pink; }

	div {
	 #display: inline-block;
	  float: center;
#	  background-color:red;
	  margin:auto;
	  width:60%;
	  padding:10px;
	}

	img {
	  float:center;
	  margin:auto;
	  align:center;
	}

	pix {
	background-color:white;
	foreground-color:black;
	}
	</style>

<script type="text/javascript" src="http://code.jquery.com/jquery-1.4.4.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

	$pagination = $("#info");

	$images = $("#pix li");

	$images.click(function(e) {
		e.preventDefault();
		$images.eq(current).removeClass('active');
		current = ($(this).index());
		$images.eq(current).addClass('active');
		title();
	});

	/* Total of images */
	total = $images.length;

	/* Current image index */

	if (location.hash) {
		f = $images.find('a[href="' + location.hash.substr(1) + '"]:last');
		current = f.closest('li').index();
	} else {
		current = $pagination.data("Current") ? $pagination.data("Current") : 0;
	}
	$images.eq(current).addClass('active');
	title();

	$(document).keydown(function(e) {
		if (e.keyCode == 37) {
			prev();
			return false;
		}
		if (e.keyCode == 39) {
			next();
			return false;
		}
	});

	$('#image').click(function() {
		next();
	});

});

function next() {
	$images.eq(current).removeClass('active');
	current = ((current + 1) == total ? 0: (current + 1));
	$images.eq(current).addClass('active');
	$pagination.data("Current", current);
	title();
}

function prev() {
	$images.eq(current).removeClass('active');
	current = ((current - 1) < 0 ? (total - 1) : (current - 1));
	$images.eq(current).addClass('active');
	$pagination.data("Current", current);
	title();
}

function title() {
	/* Update which image is visible and the label */
	//$('#image').html("<img src =" + $images[current].textContent + " />");
	$('#image').attr("src", $images[current].textContent);
	document.title = ("[" + (current + 1) + " of " + total + "]");
	location.hash = $images[current].textContent;
}
</script>


</head>

<body>

  <h1 id="info"></h1>
  
  <div>
	<img id="image"/>
  </div>
  
  <button onclick="next();">&gt;</button>
  <button onclick="prev();">&lt;</button>

  <ul id="pix" class="pix">
<?php
$cmd = <<<TEST
for i in *.png *.jpg *.gif; do
        echo "<li><a href=\"\$i\">\$i</a></li>"
done | sort -r
TEST;

passthru($cmd);
?>
  </ul>


  
</body>
</html>
