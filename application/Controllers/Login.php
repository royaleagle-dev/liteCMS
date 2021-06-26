<?php
use Authentication\Login as Auth;

class Login extends Controller{

    public function __construct(){
    }

    public function index(){
        $data = array();
        $data['colors'] = COLORS;
        $session = new Session();
        new Template("login.html", $data);
    }
    public function auth(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if ($_POST['type'] == 'login'){
                $email = $_POST['email'];
                $password = $_POST['password'];
                $color = $_POST['color'];

                $authenticate = new Auth ($email, $password);
                $authenticate = $authenticate->log_user_in($color);
                if($authenticate){
                    $url = redirect('dashboard');
                    $_SESSION['msg'] = "User Successfully Authenticated";
                    echo json_encode(array("msg"=>"Login Attempt was Successful", "location"=>"$url"));
                }else{
                    echo json_encode(array("msg"=>"Login Attempt Failed"));
                }
            }
        }
    }
}

?>