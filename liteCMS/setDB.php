<?php

require_once "Core/Database.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	$referrer = $_SERVER['HTTP_REFERER'];
	
	$dbase_name = $_POST['dbase_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = password_hash($password, PASSWORD_DEFAULT);

	$settings = file_exists('settings.ini') ? file_get_contents('settings.ini'):exit("settings not Found");
	$dbase_name_pattern = "/dbase_name ?= ?''/";
	$dbase_set_pattern = "/dbase_set ?= ?'false'/";
	preg_match_all($dbase_name_pattern, $settings, $matches, PREG_SET_ORDER);
	$settings = preg_replace($dbase_name_pattern, "dbase_name = '$dbase_name'", $settings);
	preg_match_all($dbase_set_pattern, $settings, $matches, PREG_SET_ORDER);
	$settings = preg_replace($dbase_set_pattern, "dbase_set = 'true'", $settings);
	file_put_contents('settings.ini', $settings);

	//email & password;
	$email_n_pass = "\nemail = '$email'\npassword = '$password'";
	file_put_contents("settings.ini", $settings.$email_n_pass);

	
	$create_post_table = Database::$database = $dbase_name;
	Database::query("CREATE TABLE lite_post (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    body TEXT(30000) NOT NULL,
    author VARCHAR(255) NOT NULL,
    likes INTEGER DEFAULT(0) NOT NULL
	)");
	$create_comment_table = Database::query("CREATE TABLE lite_comment(
    id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
    post INTEGER NOT NULL,
    commenter VARCHAR(255) NOT NULL
	)");
	$create_tag_table = Database::query("CREATE TABLE lite_tags(
    id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    color_code VARCHAR(9) NOT NULL
	)");
	Database::query("ALTER TABLE `lite_comment` ADD FOREIGN KEY (`post`) REFERENCES `lite_post`(`id`) ON DELETE CASCADE ON UPDATE CASCADE; ");

	if($create_post_table && $create_comment_table && $create_tag_table){
		echo json_encode(array("referrer"=>$referrer));
	}


}
?>