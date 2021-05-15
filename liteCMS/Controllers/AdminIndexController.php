<?php

class AdminIndexController extends Controller{
	
	public function index(){
		$post_list = Database::query("SELECT * FROM lite_post WHERE status = ?", $params = array(1), $fetchmode = "fetchAll");
		$this->view->context = array('post_list'=>$post_list);
		$this->view->render("Templates/admin/index.html");
	}

	public function users(){
		$this->view->render("Templates/admin/users.html");
	}

	public function others(){
		$this->view->render("Templates/admin/others.html");
	}

	public function posts(){
		$post_list = Database::query("SELECT * FROM lite_post WHERE status = ?", $params = array(1), $fetchmode = "fetchAll");
		$this->view->context = array('post_list'=>$post_list);
		$this->view->render("Templates/admin/posts.html");
	}

	public function new_post(){
		$this->view->render("Templates/admin/new_post.html");
	}
}

?>