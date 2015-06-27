<?php

	function alert ($str)
	{
		echo "<script language = javascript>";
		echo " alert('" . $str . "');";
		echo "</script>";
	}
	
	function forward ($url)
	{
		echo "<script language = javascript>";
		echo "	location.href = '" . $url . "'";
		echo "</script>";
		exit;
	}
?>