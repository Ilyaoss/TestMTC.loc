<?php 
    define(ROOT, $_SERVER['DOCUMENT_ROOT']);
    require(ROOT.'/sys/core.php');

    $page = route(1);
    $ext = route(2);
    
    $pdo = init();
    $cookie_id = $_COOKIE['id'];
    $cookie_hash = $_COOKIE['hash'];
    $this_id = check($pdo, $cookie_id, $cookie_hash);
    
    $auth = false;
    $new_slide = false;
    $glob_item='';
    $rand=0;
    //echo $page;
    switch($page){
        case 'login':
            $tpl = 'login'; 
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $login = clearStr($_POST['login']);
                $password = clearStr($_POST['password']);
                if(strlen($login) > 2 && strlen($password) > 2){
                    //print $login.' '.$password;
                    $auth = login($pdo, $login, $password);
                    if($auth === true){
                        $message = '<p>Вы успешно авторизовались в системе. Сейчас вы будете переадресованы на главную страницу сайта. Если это не произошло, перейдите на неё по <a href="/user">прямой&nbsp;ссылке</a>.</p>';
                        header("Refresh: 3; location = /user");
                    }else{
                        //echo $auth;
                    }
                }
            }
            break;
            
        case 'register':
            $title = "Регистрация";
            $tpl = 'register';
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $login = clearStr($_POST['login']);
                $password = clearStr($_POST['password']);
                $password_double = clearStr($_POST['password_double']);
                $res;
                if(!empty($login) && !empty($password) && !empty($password_double)){
                    if($password != $password_double){
                        $res =  'Пароли не совпали!';
                    }else{
                        $res = register($pdo, $login, $password);
                        if($res===true){
                            mkdir("users/$login/");
                            header('location: /login');
                        }else{
                           // print $res;
                        }
                    }
                }
                else
                {
                    $res = 'Заполните все поля!';
                }
            }
            break;

        case 'user':
	    $tpl = 'user';  
            if( $this_id ==0){
                header('location: /login');
                print 'Сессия устарела, перезайдите снова';
            }
            else
            {
                if($ext=='addanimal'){
                    $title = "Добавление животного";
                    $tpl = 'addanimal';
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                        $nick = clearStr($_POST['nickname']);
                        $desc = clearStr($_POST['description']);
                        $age = clearStr($_POST['age']);
                        $login = getLogin($pdo,$this_id);
                        $rand = mt_rand(0, 10000);
                        $photo = "users/$login/$rand".$_FILES['picture']['name'];
                        if(!empty($nick) && !empty($age) && !empty($desc)){
                            $reg = '';
                            $reg = register_animal($pdo,$this_id, $nick, $photo, $age, $desc);
                            if($reg===true){                         
                                header('location: /user');
                            }else{
                                //print 'не удалось подключиться :('; 
                            }
                        }
                    }
                    break;
                }
                $ch_pet = cheсk_pet($pdo,$this_id, $ext);
                if($ch_pet){
                    $tpl = 'animal';
                }
                $glob_item = load_pets($pdo, $this_id);
            }
            break;
            
        case 'logout':
            setcookie("id", '', time()-3600);
            setcookie("hash", '', time()-3600);
            $glob_item='';
            header('location: /login');
        break;
    
        default:
            $title = "Standart";
            if($this_id>0)
            {
                $tpl = "user";
                if(isset($_GET['name']) && isset($_GET['owner'])){
                    delete_pet($pdo, $_GET['name'], $_GET['owner']);
                }
                header('location: /user');
            }
            else
            {
                $tpl = "login";
                header('location: /login');
            }
            //$tpl = "default";
    }
    //print '<br>'.$this_id;
    include_once(ROOT.'/sys/templates/index.tpl.php');