<div style="border: 2px solid #aa0000; background: #F8E4DF; border-radius: 3px; font-size: 12px; margin-right: 27%;margin-left: 27%; height: 430px;margin-top: 2%">
    <div style="position:absolute; top:15%; right:27%">
        <button class="btn btn-primary" onclick="location ='/user';">Назад</button>
    </div>
    <h1 class="cent">Добавить животное</h1>
<div class="row cent">
    <div class="col-md-offset-4 col-md-4">
        <div>
            <?php echo $reg; ?>
        </div>
        <form class="cent" action="" method="post" enctype="multipart/form-data">
            <p><input name="picture" type="file"    /></p>
            <p><input class="form-control" name="nickname" type="text" placeholder="Кличка" /></p>
            <p><input class="form-control" name="age" type="number" placeholder="Возраст" /></p>
            <p><input class="form-control" name="description" type="textarea" placeholder="Описание" /></p>
            <p><input class="btn btn-primary" name="register_submit" type="submit" value="Добавить" /></p><br />
        </form>
        <?php
            if($reg===true){
                // если была произведена отправка формы
                if(isset($_FILES['picture'])) {
                    // проверяем, можно ли загружать изображение
                    $check = can_upload($_FILES['picture']);

                    if($check === true){
                     // загружаем изображение на сервер
                        make_upload($_FILES['picture'],getLogin($pdo,$cookie_id),$rand);
                        echo "<strong>Файл успешно загружен!</strong><br>";
                    }
                    else{
                      // выводим сообщение об ошибке
                      echo "<strong>$check</strong>";  
                    }
                }
            }
        ?>
        <br>
    </div>
</div>
</div>