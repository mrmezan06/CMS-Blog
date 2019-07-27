<?php 
date_default_timezone_set("Asia/Dhaka");
 $currentTime=time();
//  $datetime = strftime("%Y-%m-%d %H:%M:%S",$currentTime);
 $datetime = strftime("%b-%d-%Y %H:%M:%S",$currentTime);
 echo $datetime;
?>