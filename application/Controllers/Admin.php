<?php

class Admin extends Controller {

    public function __construct(){
        $this->session = new Session();
        $session_check = $this->session->check_session_exist(array('email', 'firstname'));
        $this->session_check = true;
        if(!$session_check){
            $url = redirect('login');
            $_SESSION['msg'] = "User not authoized";
            header("location: $url");
            $this->session_check = false;
        }
        if(!$this->session_check){exit ("Not Authenticated");}
        $this->postModel = $this->loadModel('Post');
        $this->tagModel = $this->loadModel('Tag');
        $this->mediaModel = $this->loadModel('Media');
    }


    public function index(){
        $fivePosts = $this->postModel->get5Posts();
        $countStats = $this->postModel->countStats();
        $data = [
            'fivePosts'=>$fivePosts,
            'allPosts' => $countStats[0],
            'published' => $countStats[1],
            'draft' => $countStats[2],
            'trashed' => $countStats[3],
        ];
        new Template("admin/index.html", $data);
    }

    public function tags(){
        $tags = $this->tagModel->getAllTags();
        $data = [
            'tags'=>$tags,
        ];
        new Template("admin/tags.html", $data);
    }

    public function searchPost(){
        $searchText = isset($_GET['searchText'])?$_GET['searchText']:"Text not set";
        $search = $this->postModel->searchPost($searchText);
        echo json_encode(array("result"=>$search, "searchText"=>$searchText));

    }

    public function updatePublishedPost(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $post_id = $_POST['post_id'];
            $tags = $_POST['tags'];
            $content = $_POST['content'];
            $author = $_SESSION['email'];
            $title = $_POST['title'];
            $post_url = str_replace(' ', '-', $title);
            $updatePost = $this->postModel->updatePost($post_id, $title, $content, $author, $post_url);
            $updatePostTags = $this->tagModel->updatePostTags($post_id, $tags);
            echo json_encode(array("status"=>'success'));
        }
    }

    public function users(){
        $users = $this->postModel->getUsers();
        $data = [
            'users'=>$users,
        ];
        new Template("admin/users.html", $data);
    }

    public function allPosts(){
        $rowCount = $this->postModel->getAllPosts()[1];
        $limit = 4;
        $page = isset($_GET['page'])?$_GET['page']:1;
        $start = ($page*$limit) - $limit;
        $pages = ceil($rowCount/$limit);
        $db = $this->postModel->getAllPosts($start, $limit)[0];
        $next = $page<$pages?$page+1:$pages;
        $prev = $page==1?1:$page-1;
        $data = [
            'allPosts'=>$db,
            'pages'=>$pages,
            'next' => $next,
            'prev' => $prev
        ];
        new Template("admin/allPosts.html", $data);
    }

    public function editPost($post_id){
        $tagList = [];
        $post = $this->postModel->getPost($post_id);
        $tags = $this->tagModel->getPostTags($post_id);
        //print_r($tags);
        foreach($tags as $tag){
          $tagList[] = $tag->tag_id;
        }
        $allTags = $this->tagModel->getAllTags();
        $data = [
            'post'=>$post,
            'tags'=>$tags,
            'tagList'=>$tagList,
            'allTags' => $allTags,
        ];
        new Template("admin/editPost.html", $data);
    }


    public function addTag(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $tagname = $_POST['tagname'];
            $insertTag = $this->tagModel->insertTag($tagname);
            if($insertTag){
                echo json_encode(array("status"=>"true"));
            }else{
                echo json_encode(array("status"=>"false"));
            }
        }
    }

    public function tagDetail($tagid){
        $tagid = $tagid[0];
        $posts = $this->tagModel->getTagDetail($tagid);
        if(!$posts){
            exit ("<b>Misc Error: </b> Unfortunately We cannot get that tag at the Moment");
        }
        $data = [
            'posts' => $posts,
            'tagName'=>$this->tagModel->getTag($tagid)->name,
        ];
        new Template('admin/tagDetail.html', $data);
    }

    public function deletePost($postid){
        $post_id = $postid[0];
        $del_post = $this->postModel->deletePost($post_id);
        if($del_post){
            $url = redirect("dashboard");
            header("location: $url");
        }else{
            print "<b>Misc Error: </b> Unfortunately something went wrong";
        }
    }

    public function deleteTag($tagid){
        $tagid = $tagid[0];
        $del_tag = $this->tagModel->deleteTag($tagid);
        if($del_tag){
            $url = redirect("tags");
            header("location: $url");
        }else{
            print "<b>Misc Error: </b> Unfortunately, Something went wrong";
        }
    }

    public function createPost($email){
        $email = $email[0];
        $tags = $this->tagModel->getAllTags();
        $data = [
            'tags'=>$tags,
        ];
        new Template("admin/createPost.html", $data);
    }

    public function publishPost(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author_email = $_POST['author_email'];
            $tags = $_POST['tags'];
            $tags = explode(',', $tags);
            $date = Date('Y-m-d');
            $time = Date('H-i-s');
            $date_posted = $date;
            
            $post_url = str_replace(' ', '-', $title);
            $post_url = $date.'-'.$time.'-'.$post_url;
            $insert = $this->postModel->insertPost($title, $content, $author_email, $post_url, $date_posted, $published = 1,);
            $post_id = $this->postModel->getPostIDByPostUrl($post_url);
            //print $tags;

            if (isset($_FILES['image']['name'])){
                $extensions = ['jpg', 'png'];
                $max_file_size = 1048560;
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                
                if ($file_size <= $max_file_size){
                    if(in_array($file_extension, $extensions)){
                        $upload_path = SYSTEM_ROOT.'/uploads/media/';
                        $upload = move_uploaded_file($_FILES['image']['tmp_name'], $upload_path.$file_name);
                        if($upload){
                            //insert details into db;
                            $upload_media = $this->mediaModel->insertMedia($upload_path.$file_name, $file_name, $post_id);
                            exit("Media file uploaded");

                        }
                        exit();
                    }else{
                        exit("File type not supported");
                    }
                }else{
                    exit("File size too large");
                }
            }

            foreach($tags as $tag){
                $insertPostTags = $this->tagModel->insertPostTags($post_id, $tag);
            }

            //echo json_encode(array("status"=>'success'));
            
        }
    }

    public function draftPost(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author_email = $_POST['author_email'];
            $tags = $_POST['tags'];
            $post_url = str_replace(' ', '-', $title);
            $insert = $this->postModel->insertPost($title, $content, $author_email, $post_url, $published = 0);
            $post_id = $this->postModel->getPostIDByPostUrl($post_url);
            foreach($tags as $tag){
                $insertPostTags = $this->tagModel->insertPostTags($post_id, $tag);
            }
            echo json_encode(array("status"=>'success'));
            
        }
    }

    public function logout(){
        Session::end_session();
        //$_SESSION['msg'] = "Session ended successfully";
        $url = "login";
        $url = redirect($url);
        header("location: $url");
    }
}
?>