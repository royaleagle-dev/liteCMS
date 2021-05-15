<?php

print_r($_GET);
$htfile = file_get_contents(".htaccess");
//print $htfile;
$pattern = "/<FilesMatch (.*)>(.*)<\/FilesMatch>/is";
preg_match_all($pattern, $htfile, $matches, PREG_SET_ORDER);

print_r($matches);

foreach($matches as $value){
	print_r($value);
	$htfile = str_replace($value[2], "\n", $htfile);
}

file_put_contents('.htaccess', $htfile);
//unlink(".htaccess");

?>