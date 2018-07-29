<div style="border: 2px solid #aa0000; background: #F8E4DF; border-radius: 3px; font-size: 12px; margin-right: 27%;margin-left: 27%; height: 430px;margin-top: 2%">
    <div style="position:absolute; top:15%; right:27%">
        <button class="btn btn-primary" onclick="location ='/login';">Назад</button>
    </div>
    <h1 class="cent">Регистрация</h1>
    <div class="row cent">
        <div class="col-md-offset-4 col-md-4">
            <div>
                <?php echo $res; ?>
            </div>
            <form class="cent" action="" method="post">
                <p><input class="form-control" name="login" type="text" placeholder="login" /></p>
                <p><input class="form-control" name="password" type="password" placeholder="Пароль" /></p>
                <p><input class="form-control" name="password_double" type="password" placeholder="Повторите пароль" /></p><br />
                <p><input class="btn btn-primary" name="register_submit" type="submit" value="Зарегистрироваться" /></p><br />
            </form>
        </div>
    </div>
</div>