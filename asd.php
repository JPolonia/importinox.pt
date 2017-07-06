<?php
$time = new DateTime('now', new DateTimeZone('GMT'));
echo $time->format('F j, Y H:i:s');


$t = time();
$x = $t+date("Z",$t);
echo strftime("%B %d, %Y @ %H:%M:%S UTC", $x);

echo date('H:i');

?>
