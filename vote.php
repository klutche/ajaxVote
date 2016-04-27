<?php
// カウントアップ処理
$file	= $_POST['file'];
$count	= $_POST['count'];
$check	= $_SERVER['HTTP_X_REQUESTED_WITH'];

if ($file && $count && $check && strtolower($check) == 'xmlhttprequest') {
	$filename = 'data/'.$file.'.dat';
	$fp = @fopen($filename, 'w');
	flock($fp, LOCK_EX);
	fputs($fp, $count);
	flock($fp, LOCK_UN);
	fclose($fp);
	echo 'success';
}
