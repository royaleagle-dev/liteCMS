<?php

class SetDatabaseController extends Controller{
	
	public function index(){
		$data = array(
			'title'=>"Set Up Your Database",
		);
		$this->view->context = $data;
		$this->view->render("Templates/setDB.html");
	}
}

?>