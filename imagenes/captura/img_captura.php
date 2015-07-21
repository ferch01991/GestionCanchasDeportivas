<?php
$a='img';
$im = imagegrabscreen();
imagepng($im, "".$a.".png");
//imagedestroy($im);
?>
	<script type="text/javascript">
	 alert("IMAGEN CAPTURADA");
    location.href = "../../vistas/cancha3.php";
	</script>
	<?php
?>