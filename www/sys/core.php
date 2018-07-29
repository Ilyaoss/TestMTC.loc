<?php
/* 
* This core functions for application
*/
//include('config.ini'); 
// Обработка текста
function clearInt($num){
    return abs((int)$num);
}

function clearStr($str){
    return trim(strip_tags($str));
}

function clearHTML($html){
    return trim(htmlspecialchars($html));
}

/* Route functions */
function route($item = 1) {
    $request = explode("/", $_SERVER["REQUEST_URI"]);
    return $request[$item];
}

// Соединение с БД
function init(){
    $config = parse_ini_file(ROOT.'/sys/config.ini');
    //print_r($config);
    $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['schema']}";
    return new PDO($dsn, $config['user'], $config['password']);
}

function register($pdo, $login, $password){
    $error = '';
    if (preg_match("#[А-Яа-яёЁ]+#",$login)){ 
        $error = 'Нельзя использовать русские буквы в логине';
        return $error;
    }
    if (!preg_match("/^[A-Za-z]+/",$login)){
        $error = 'Используйте в логине только английские буквы и цифры';
        if (preg_match("/^[0-9]+/",$login)){
            $error = 'Логин должен начинаться с буквы!';
        }
        return $error;
    }
    if (preg_match("#[А-Яа-яёЁ]+#",$password)){ 
        $error = 'Нельзя использовать русские буквы в пароле';
        return $error;
    }
    $login = $pdo->quote($login);//читает из этого столбца
    $password = md5($password);
    $password = $pdo->quote($password);
    //print $login.' '.$password;
    $sql_check = "SELECT COUNT(id) FROM users WHERE login=$login";
    $stmt = $pdo->query($sql_check); //Выполняет запрос к базе данных
    $row = $stmt->fetch(PDO::FETCH_NUM); //возвращает массив, индексированный номерами столбцов
    if($row[0] > 0){
        $error = 'Учетная запись уже существует. Забыл пароль?';
        return $error;
    }else{
        // Добавляем учетную запись в таблицу users
        $sql_insert = "INSERT INTO users (login, password) VALUES ($login, $password)";
        //print $sql_insert;

        if($pdo->exec($sql_insert)){
            return true;
        }else{
            $error = 'Ошибка связи!';
            return $error;
        }
    }
}

function login($pdo, $login, $password){
    // Инициализируем переменную с возможным сообщением об ошибке
    $error = '';

    // Если отсутствует строка с логином, возвращаем сообщение об ошибке
    if(!$login) 
    {
        $error = 'Не указан логин';
        return $error;
    } 
    elseif(!$password) 
    {
        $error = 'Не указан пароль';
        return $error;
    }
    $login = $pdo->quote($login);
    $password = md5($password);
    //print $login.' '.$password;
    $sql = "SELECT id, password FROM users WHERE login=$login";
    if(!$stmt = $pdo->query($sql)){
        $error = 'Ошибка подключения к БД';
        return $error;
    } else {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);//возвращает массив, индексированный именами столбцов результирующего набора
        if(!$row){
            $error = "Неверный логин!";
            return $error; 
        } else {
            $db_password = $row['password'];
            $db_id = $row['id'];
            
            $error = 'Неверный пароль, попробуйте ещё раз!';
            
            if($password == $db_password){
                $hash = md5(rand(0, 6400000));
                $sql_update = "UPDATE users SET hash='$hash' WHERE id='$db_id'";
                if($pdo->exec($sql_update)){
                    setcookie("id", $db_id, time() + 3600);
                    setcookie("hash", $hash, time() + 3600);
                    return true;
                }else{
                    $error = 'Ошибка выполнения.';
                    //print 'Exception';
                }
            }
            return $error;
        }
    }
}

function register_animal($pdo, $user_id, $nick, $photo, $age, $desc){
    $nick = $pdo->quote($nick);//читает из этого столбца
    $desc = $pdo->quote($desc);//читает из этого столбца
    $photo = $pdo->quote($photo);//читает из этого столбца
    $sql_check = "SELECT COUNT(id) FROM pet WHERE owner_id=$user_id and name=$nick";
    $stmt = $pdo->query($sql_check); //Выполняет запрос к базе данных
    $row = $stmt->fetch(PDO::FETCH_NUM); //возвращает массив, индексированный номерами столбцов
    if($row[0] > 0){
        return 'Такое животное уже существует!';
    }else{
        // Добавляем учетную запись в таблицу na_users
        $sql_insert = "INSERT INTO pet (name, age, description, owner_id, image) "
                . "VALUES ($nick, $age, $desc, $user_id, $photo)";

        if($pdo->exec($sql_insert)){
            return true;
        }else{
            return false;
        }
    }
}

function load_pets($pdo, $owner_id){
    $glob_item = '';
    $sql_check = "SELECT * FROM pet WHERE owner_id=$owner_id";
    $stmt = $pdo->query($sql_check); //Выполняет запрос к базе данных
    $row = $stmt->fetchAll(PDO::FETCH_NUM); //возвращает массив, индексированный номерами столбцов
    if(count($row) == 0){
        return "";
    }else{
        for($i=0;$i<count($row);){
            
            $name = $row[$i][1];
            $photo = $row[$i][5];
            //$name=urldecode($name);
            //$age = $row[$i][2];
            $i++;
            $glob_item = $glob_item."<div class='item' style = 'background-image:url($photo);'>
                            <h2 style='font-family: Test; '><span style = 'background: white; color: black'>&nbsp;$name&nbsp;</span></h2>
                            <br><br><br><br><br>
                            <button class='btn btn-primary btn-lg' onclick=\"location='/user/$name'\">Подробнее</button>
                            <br><br><a class='close' href='index.php?name=$name&owner=$owner_id'></a>
                            </div>";
        }
        return $glob_item;
    }
}

function cheсk_pet($pdo, $this_id, $ext){
    $sql_check = "SELECT * FROM pet WHERE owner_id=$this_id";
    $stmt = $pdo->query($sql_check); //Выполняет запрос к базе данных
    $row = $stmt->fetchAll(PDO::FETCH_NUM); //возвращает массив, индексированный номерами столбцов
    if(count($row) == 0){
        return false;
    }else{
        for($i=0;$i<count($row);$i++){            
            if($row[$i][1]==urldecode($ext)){
                return $row[$i][5];
            }
        }
        return false; 
    }
}

function delete_pet($pdo,$name,$owner_id){
    
    $name = $pdo->quote($name);
    if(del_pet_photo($pdo,$name,$owner_id)===true){
        $sql_del = "DELETE FROM pet WHERE owner_id=$owner_id AND name=$name";
        if($pdo->exec($sql_del)){ 
            return true;
        } 
        else{
            return false;
        }
    }
    else{
        return "Ошибка удаления";
    }
}

function del_pet_photo($pdo,$name,$owner_id){
    $sql_check = "SELECT * FROM pet WHERE owner_id=$owner_id AND name=$name";
    $stmt = $pdo->query($sql_check); //Выполняет запрос к базе данных
    $row = $stmt->fetchAll(PDO::FETCH_NUM); //возвращает массив, индексированный номерами столбцов
    if(count($row) == 0){
        return "Нет такого животого";
    }else{
        $photo = $row[0][5];
        unlink("$photo");
        return true;
    }
}

function check($pdo, $cookie_id, $cookie_hash){
    
    if(empty($cookie_id) || empty($cookie_hash)){
        return 0;
    } else {
        $sql = "SELECT hash FROM users WHERE id='$cookie_id'";
        if(!$stmt = $pdo->query($sql)){
            return 0;
        } else {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!$row){
                return 0;
            } else {
                $db_hash = $row['hash'];
                if($cookie_hash == $db_hash){
                    return $cookie_id;
                }
                return 0;
            }
        }
    }
}

function getLogin($pdo, $id){
    $sql_check = "SELECT login FROM users WHERE id=$id";
    $stmt = $pdo->query($sql_check); //Выполняет запрос к базе данных
    $row = $stmt->fetch(PDO::FETCH_NUM); //возвращает массив, индексированный номерами столбцов
    if(!row){
        return "";
    }else{
        return $row[0];
    }
}

function can_upload($file){
    // если имя пустое, значит файл не выбран
    if($file['name'] == '')
        return 'Вы не выбрали файл.';
	
    /* если размер файла 0, значит его не пропустили настройки 
    сервера из-за того, что он слишком большой */
    if($file['size'] == 0)
        return 'Файл слишком большой.';

    // разбиваем имя файла по точке и получаем массив
    $getMime = explode('.', $file['name']);
    // нас интересует последний элемент массива - расширение
    $mime = strtolower(end($getMime));
    // объявим массив допустимых расширений
    $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

    // если расширение не входит в список допустимых - return
    if(!in_array($mime, $types))
        return 'Недопустимый тип файла.';

    return true;
}

function make_upload($file, $login,$rand){	
    // формируем уникальное имя картинки: случайное число и name
    //echo "users/$login/";	
    copy($file['tmp_name'], "users/$login/$rand".$file['name']);
  }

function getDesc($pdo,$id,$name){
    $name = $pdo->quote(urldecode($name));
    $sql_check = "SELECT description FROM pet WHERE owner_id=$id and name=$name";
    $stmt = $pdo->query($sql_check); //Выполняет запрос к базе данных
    $row = $stmt->fetch(PDO::FETCH_NUM); //возвращает массив, индексированный номерами столбцов
    if(!row){
        return "";
    }else{
        return $row[0];
    }
}

function getAge($pdo,$id,$name){
    $name = $pdo->quote(urldecode($name));
    $sql_check = "SELECT age FROM pet WHERE owner_id=$id and name=$name";
    $stmt = $pdo->query($sql_check); //Выполняет запрос к базе данных
    $row = $stmt->fetch(PDO::FETCH_NUM); //возвращает массив, индексированный номерами столбцов
    if(!row){
        return "";
    }else{
        return $row[0];
    }
}

