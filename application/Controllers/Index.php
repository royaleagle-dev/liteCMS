<?php

class Index extends Controller {

    public function __construct(){
        //$this->churchModel = $this->loadModel('Church');
        //var_dump($this->churchModel);
        $this->postModel = $this->loadModel('Post');
        $this->tagModel = $this->loadModel('Tag');
    }

    public function blogPost($post_url){
        $data = [

        ];
        new Template("post.html", $data);
    }

    public function index(){
        $posts = $this->postModel->getPostsWithMedia();
        $tags = $this->tagModel->getAllTags();
        $data = [
            'posts'=>$posts,
            'tags'=>$tags,
        ];
        new Template("index.html", $data);
    }
}

?>