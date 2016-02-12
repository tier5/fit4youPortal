<?php
echo "Server Time Now: ".date("Y-m-d H:i:s")."<br>";

echo "From Time: ".date('Y-m-d H:i:s',strtotime('+1 minutes'))."<br>";
echo "To Time: ".date('Y-m-d H:i:s',strtotime('-60 minutes'))."<br>";

?>