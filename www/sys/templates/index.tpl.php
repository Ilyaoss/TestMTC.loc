<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?=$title?></title>
        <!-- Bootstrap -->
        <!--<link href="/assets/css/bootstrap.css" rel="stylesheet">
        <link href="/assets/css/bootstrap-theme.css" rel="stylesheet">-->
        <link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet">
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="/assets/css/font-awesome.css" rel="stylesheet">
        <link href="/assets/css/style.css" rel="stylesheet">
        <!--[if lt IE 9]>
         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!--<script src="/assets/js/jquery-2.1.4.min.js"></script>-->
        <script src=https://code.jquery.com/jquery-3.3.1.min.js></script>
        <!--<script src="/assets/js/bootstrap.js"></script>-->
        <script src="/assets/js/bootstrap.min.js"></script>
        <style>
        @font-face {
            font-family: "Test"; /* Гарнитура шрифта */
            src: url('/assets/fonts/11380.ttf'); /* Путь к файлу со шрифтом */
        }
        body{
            background-image: url(/assets/img/bg.jpg);
        }
        h3{
            font-family: Test;
        }
        
        .carousel .item{
            background: #F9CDBD; 
            text-align: center;
            height: 300px;
            background-repeat: no-repeat;
            background-position: center;
            -webkit-background-size: cover ;
            background-size: cover ;
            margin: 0 auto;
        }
        .carousel h2{
            color: #816BFF;
            margin: 0;
            padding-top: 50px;
            font-size: 48px;
        }
        .carousel p{
            color: white;
            font-weight: bold;
            font-size: 16px;
            margin-top: 30px;
            margin-bottom: 40px;
        }
        .carousel{
            margin-left: 10%;
            margin-right: 10%;
        }
        .cent input{
            margin: auto;
            
        }
        .close {
            position: absolute;
            right: 17%;
            top: 25px;
            width: 32px;
            height: 32px;
            opacity: 1;
        }
        .close:hover {
            opacity: 1;
        }
        .close:before, .close:after {
            position: absolute;
            left: 15px;
            content: ' ';
            height: 33px;
            width: 5px;
            background-color: white;
            border: 1px solid black;
        }
        .close:before {
            transform: rotate(45deg);
        }
        .close:after {
            transform: rotate(-45deg);
        }
        
        </style>
    </head>
    <body>
        <!--<section class="container">-->
        <div style="margin-left: 32%;margin-top: 2%;">
            <img src="/assets/img/cat.png" width= 180px; height= 100px; >
            <img src="/assets/img/logo.png" width= 280px; height= 100px>
        </div>
        <?php include_once(ROOT.'/sys/templates/'.$tpl.'.tpl.php'); ?>
        <!--</section>
        <footer>
            <p><small> Илья Шачнев &copy; 2018</small></p>
        </footer>-->
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/assets/js/bootstrap.js"></script>
        <script type="text/javascript" src="/simplebox_util.js"></script>
        <script type="text/javascript">
        (function(){
        var boxes=[],els,i,l;
        if(document.querySelectorAll){
        els=document.querySelectorAll('a[rel=simplebox]');	
        Box.getStyles('simplebox_css','/simplebox.css');
        Box.getScripts('simplebox_js','/simplebox.js',function(){
        simplebox.init();
        for(i=0,l=els.length;i<l;++i)
        simplebox.start(els[i]);
        simplebox.start('a[rel=simplebox]');			
        });
        }
        })();</script>
    </body>
</html>