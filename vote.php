<?php
/* カウントアップ処理
--------------------------------------------------*/

$file	= $_GET['file'];
$count	= $_GET['count'];

// カウントアップ
$filename = 'data/'.$file.'.dat';
$fp = @fopen($filename, 'w');
flock($fp, LOCK_EX);
fputs($fp, $count);
flock($fp, LOCK_UN);
fclose($fp);
