<?php

class Tag{

    public function __construct(){
        $this->db = new Database();
    }

    public function getTag($tag_id){
        $statement = $this->db->query("SELECT * FROM lite_tags WHERE id=?", $params=array($tag_id), $fetchMode="fetch");
        return $statement;
    }

    public function getTagDetail($tagid){
        $statement = $this->db->query("SELECT lite_posts_tags.*, lite_post.* FROM lite_posts_tags LEFT JOIN lite_post ON lite_posts_tags.post_id = lite_post.id  WHERE tag_id=?", $params=array($tagid), $fetchmode='fetchAll');
        return $statement;
    }

    public function getPostTags($post_id){
        $post_id = $post_id[0];
        //print $post_id;
        $statement = $this->db->query("SELECT * FROM lite_posts_tags WHERE post_id=?", $params=array($post_id), $fetchMode = 'fetchAll');
        //print_r($statement);
        return $statement;
    }

    public function getAllTags(){
        $statement = $this->db->query("SELECT * FROM lite_tags", $params = array(), $fetchmode = 'fetchAll');
        return $statement;
    }

    public function insertTag($tagname){
        $statement = $this->db->query("SELECT * FROM lite_tags WHERE name = ?", $params = array($tagname), $fetchmode = 'fetch');
        if($statement){
            return false;
        }
        $statement = $this->db->query("INSERT INTO lite_tags (name) VALUES(?)", $params = array($tagname));
        if ($statement){
            return true;
        }

    }

    public function insertPostTags($post_id, $tag_id){
        $statement = $this->db->query("INSERT INTO lite_posts_tags (post_id, tag_id) VALUES(?, ?)", $params=array($post_id, $tag_id));
        if($statement){
            return true;
        }else{
            return false;
        }
    }

    public function deleteTag($tagid){
        $statement = $this->db->query("DELETE FROM lite_tags WHERE id=?", $params = array($tagid));
        if($statement){
            return true;
        }else{
            return false;
        }
    }

    public function updatePostTags($post_id, $tags){
        $DbaseTagList =[];
        $DBtags = $this->db->query("SELECT tag_id FROM lite_posts_tags WHERE post_id=?", $params=array($post_id), $fetchMode='fetchAll');
        foreach($DBtags as $tag){
            $DbaseTagList[] = $tag->tag_id;
        }

        if(!is_null($DbaseTagList)){
            foreach($DbaseTagList as $dbTag){
                if(!in_array($dbTag, $tags)){
                    print "I'm Here right before delete";
                    $statement = $this->db->query("DELETE FROM lite_posts_tags WHERE post_id=? AND tag_id=?", $params=array($post_id, $dbTag));
                }
            }
        }

        foreach ($tags as $tag){
            if(!in_array($tag, $DbaseTagList)){
                $statement= $this->db->query("INSERT INTO lite_posts_tags (post_id, tag_id) VALUES(?,?)", $params = array($post_id, $tag));
            }
        }
    
    }
}

?>