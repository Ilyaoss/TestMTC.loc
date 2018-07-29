<?php
$login= getLogin($pdo, $cookie_id);
$photo=$ch_pet;
$desc = getDesc($pdo,$cookie_id,$ext);
$age = getAge($pdo,$cookie_id,$ext);
?>
<div style="position:absolute; top:10%; right:10%">
    <button class="btn btn-primary" onclick="location ='/user';">Назад</button>
</div>
<div style="margin-left:  10%;margin-top:  1%">
    <a rel="simplebox" href="<?php echo "/$photo"?>">
    <img src="<?php echo "/$photo"?>" align='left' width=150 height=150></a>
    <div style="border: 2px solid #aa0000; background: #F8E4DF; border-radius: 3px; font-size: 12px; font-family: Test; margin-right: 11%;margin-left: 13%; height: 150px;">
        <h2 style = "font-family: Test;"><strong> &nbsp; &nbsp; &nbsp;<?php echo urldecode($ext)?></strong></h2>
        <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Возраст: <?php echo $age;?></h5>
        <h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Описание: <?php echo $desc?></h5>
    </div>
 </div>

                            


