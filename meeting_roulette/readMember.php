<?php
$param = $_GET;
$backupFiles = scandir('./members/');
$fileName = "./members/".$backupFiles[$param["n"]];
if(file_exists($fileName)){
	echo file_get_contents($fileName);
} else {
	exit("ERROR: ファイルが存在しません->");
}