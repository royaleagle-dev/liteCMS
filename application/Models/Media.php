<?php

class Media{

    public function __construct(){
        $this->db = new Database();
    }

    public function insertMedia($media_path, $media_name, $media_post){
        $statement = $this->db->query("INSERT INTO lite_media(media_path, media_name, media_post) VALUES(?,?,?)", 
        $params = array($media_path, $media_name, $media_post));
        return true;
    }
}