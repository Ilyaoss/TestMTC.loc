<div style="position:absolute; top:10%; right:10%">
<button class="btn btn-primary" onclick="location ='/logout';">Выход</button>
</div>
<div style="margin-left:  10%;margin-top:  1%">
    <img src='/assets/img/std_avatar.jpg' align='left' width=150 height=150>
    <div style="border: 2px solid #aa0000; background: #F8E4DF; border-radius: 3px; font-size: 12px; font-family: Test; margin-right: 11%;margin-left: 13%; height: 150px;">
    <?php
    echo "<h2 style = 'font-family: Test;'><strong> &nbsp; &nbsp; &nbsp;".getLogin($pdo,$cookie_id)."</strong></h2>";
    ?>
    </div>
</div>
<br><br>
<div id="testCarousel" class="carousel slide" data-ride="carousel">
	<!-- Слайды карусели -->
	<div class="carousel-inner">
            <!-- Слайд 1 -->
            <div class="item active">
                <h2 style="font-family: Test; "><span style = "background: white; color: black">&nbsp;Мои животные&nbsp; </span></h2><br><br><br>
                <p><button class="btn btn-primary btn-lg" onclick="location='/user/addanimal'">Добавить животное</button></p>
            </div>
            <?php echo $glob_item;                      
            ?>
	</div>

	<!-- Навигация карусели (следующий или предыдущий слайд) -->
	<!-- Кнопка, переход на предыдущий слайд с помощью атрибута data-slide="prev" -->
	<a class="left carousel-control" href="#testCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left"></span>
	</a>
	<!-- Кнопка, переход на следующий слайд с помощью атрибута data-slide="next" -->
	<a class="right carousel-control" href="#testCarousel" role="button" data-slide="next">
		<span class="glyphicon glyphicon-chevron-right"></span>
	</a>
</div>

                            

