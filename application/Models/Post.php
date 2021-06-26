<?php

class Post{

    public function __construct(){
        $this->db = new Database();
    }

    public function getPostsWithMedia(){
        $statement = $this->db->query("SELECT lite_post.*, lite_authors.firstname FROM lite_post 
        LEFT JOIN lite_authors ON lite_post.author=lite_authors.id
        WHERE trashed=? AND published=? ORDER BY id DESC", $params = array(0, 1), $fetchmode = 'fetchAll');
        
        $results = [];

        foreach ($statement as $data){
            $main_media = $this->db->query("SELECT * FROM lite_media WHERE media_post=?", $params = array($data->id), $fetchMode = 'fetch');
            if($main_media){
                //print_r($main_media);
                $media_name = $main_media->media_name;
                $media_path = $main_media->media_path;
                $results[] = array('dbase'=>$data, 'media'=>[$media_name, $media_path]);
            }else{
                //print "Media does not exist for this entry";
            }
        }

        //print_r($results);
        //return $statement;
        return $results;
    }

    public function countStats(){
        $allPost = $this->db->query("SELECT * FROM lite_post", $params=array())->rowCount();
        $published = $this->db->query("SELECT * FROM lite_post WHERE published=?", $params=array(1))->rowCount();
        $draft = $this->db->query("SELECT * FROM lite_post WHERE published=?", $params=array(0))->rowCount();
        $trashed = $this->db->query("SELECT * FROM lite_post WHERE trashed=?", $params=array(1))->rowCount();
        return [$allPost, $published, $draft, $trashed];
    }

    public function getAllPosts($start =0, $limit=0){
        $countAllPost = $this->db->query("SELECT * FROM lite_post", $params=array());
        $countAllPost = $countAllPost->rowCount();
        $statement = $this->db->query("SELECT lite_post.*,lite_authors.firstname, lite_authors.lastname
        FROM lite_post LEFT JOIN lite_authors ON lite_post.author=lite_authors.id ORDER BY id DESC LIMIT $start, $limit", $params=array(), $fetchMode = 'fetchAll');
        return [$statement, $countAllPost];
    }

    public function insertPost($title, $content, $author, $post_url, $date_posted, $published = 1){
        //print $colsStr;
        $author = $this->db->query("SELECT id FROM lite_authors WHERE email=?", $params = array($author), $fetchmode="fetch");
        $author = $author->id;
        $statement = $this->db->query("INSERT INTO lite_post (title, content, author, published, post_url, date_posted) VALUES (?, ?, ?, ?, ?, ?)", $params = array($title, $content, $author, $published, $post_url, $date_posted));
        return true;
    }

    public function get5Posts(){
        $statement = $this->db->query("SELECT lite_post.*, lite_authors.firstname FROM lite_post LEFT JOIN lite_authors ON lite_post.id=lite_authors.id WHERE trashed=? AND published=? ORDER BY id DESC", $params = array(0, 1), $fetchmode = 'fetchAll');
        $results = array();
        $fetched = 1;
        foreach($statement as $result){
            if($fetched <= 5){
                $results[] = $result;
                $fetched++;
            }
        }
        return $results;
}

    public function deletePost($post_id){
        $statement = $this->db->query("UPDATE lite_post SET trashed=? WHERE id=?", array(1, $post_id));
        if($statement){
            return true;
        }else{
            return false;
        }
    }

    public function getPost($post_id){
        $post_id = $post_id[0];
        $statement = $this->db->query("SELECT * FROM lite_post WHERE id=?", array($post_id), $fetchmode = 'fetch');
        return $statement;
    }

    public function updatePost($post_id, $title, $content, $author, $post_url, $published = 1){
        //print $colsStr;
        $author = $this->db->query("SELECT id FROM lite_authors WHERE email=?", $params = array($author), $fetchmode="fetch");
        $author = $author->id;
        $statement = $this->db->query("UPDATE lite_post SET title=?, content=?, author=?, published=?, post_url=? WHERE id=?", $params = array($title, $content, $author, $published, $post_url, $post_id));
        return true;
    }

    public function getPostIDByPostUrl($post_url){
        $statement = $this->db->query("SELECT id FROM lite_post WHERE post_url=?", $params=array($post_url), $fetchMode='fetch');
        return $statement->id;
    }

    public function searchPost($text){
        $statement = $this->db->query("SELECT * FROM lite_post WHERE title LIKE '%{$text}%'", $params=array(), $fetchMode='fetchAll');
        return $statement;
    }
}