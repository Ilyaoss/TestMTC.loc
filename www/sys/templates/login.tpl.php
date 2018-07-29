<div style="border: 2px solid #aa0000; background: #F8E4DF; border-radius: 3px; font-size: 12px; margin-right: 27%;margin-left: 27%; height: 430px;margin-top: 2%">
<?php if($auth!==true){?>
    <h1 class="cent">Пройдите авторизацию</h1>
    <div class="row cent">
        <div class="col-md-offset-4 col-md-4">
            <div>
                <?php echo $auth; ?>
            </div>
            <form class="cent" action="" method="post">
                <p><input class="form-control" name="login" type="text" placeholder="login" /></p>
                <p><input class="form-control" name="password" type="password" placeholder="Пароль" /></p><br />
                <p><input class="btn btn-primary" name="login_submit" type="submit" value="Представиться" /></p><br />
            </form>
            <p class="to_reg">Если вы не зарегистрированы в системе, <a href='register'>зарегистрируйтесь</a>.</p>
        </div>
    </div>

<?php
}else{
    echo "<h2 class='cent' style='margin-top:20%;'>$message</h2>";
}?>
</div>