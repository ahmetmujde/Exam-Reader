<?php 

if(isset($_GET["script"])=="on"){

    echo "<script>alert('Sizin Zaten Bir Kodunuz Var ')</script>";
}

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="vieport" content="width=device=width,initial=scale=1,shrick=to=fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Optik Okuma</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   
    <link href="https://fonts.googleapis.com/css?family=Slabo+27px&display=swap&subset=latin-ext" rel="stylesheet">
   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="css/swiper.min.css">


</head>
<!-- Creator : Ahmet Tayyip Mujde -->

<body >
<!-- nav menü-->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar10">
            <ul class="navbar-nav nav-fill w-100">
                <li class="nav-item">
                <a class="navbar-brand text-center" href="index.php"> <i class="fas fa-file-download">&nbsp;&nbsp;</i>OPTİK OKUT </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<br>
<br>


<div class="container">
<div class="row mt-1">

<div class="col-md-6">
    <div class="box">
        <form enctype='multipart/form-data' action="sorgula.php" method="POST" >
                <span class="text-center">OPTİK FORM OLUSTURMA</span>

                <br><br>
            <div class="input-container">		 
                <input type="FILE" name="dosya"  accept=".txt">
            </div>
            <input type="hidden" value="on"  name="kontrol">
            <input class="submit1" type="submit" name="GONDER" >
        </form>	
    </div>
</div>


<div class="col-md-6">
    <div class="boxtwo">
        <form enctype='multipart/form-data' action="kodgirisi.php" method="POST" >
            <span class="text-center">KOD İLE GİRİS YAP</span>
            <br><br>
            <div class="input-container">
                <h3 class="text">Sınav Numaranız </h3>		 
                <input type="text" name="sınavno">
            </div>  

            <input class="submittwo" type="submit" name="GONDER">
        </form>	
    </div>
</div>
</div>
</div>


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<hr class="hr-1">
<div class="swiper-container">
    <div class="swiper-wrapper">
        
        <div class="swiper-slide" id="error">
            <div class="card2">
                <div class="sliderText">
                    <h3>Uyarı</h3>
                </div>
                
                <div class="content">
                   
                <p>Dosyanızın uzantısı <strong>.txt </strong>olmalıdır. 
                    
                <br><br> 
                
                Aksi takdirde program calışmayacaktır.</p>
                    
                    <a href="yardim.php">Daha fazlası</a>
                    
                </div>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="card2">
                <div class="sliderText">
                    <h3>Uyarı</h3>
                </div>
                
                <div class="content">
                    <p>Optikde okutacağınız dosyanızın içeriği sistem dosyasıyla entegre edilmiş olması gerekmektedir.
                        <br><br>
                        Programın içeği hakkında bilgi edinmek istiyorsanız <strong> daha fazla </strong>butonuna tıklayınız.
                    </p>
                    
                    <a href="yardim.php">Daha fazlası</a>
                    
                </div>
            </div>
        </div>

        <div class="swiper-slide">
            <div class="card2">
                <div class="sliderText">
                    <h3>Hatırlatma</h3>
                </div>
                
                <div class="content">
                    <p>Dosyanızda Test ile ilgili bilgilerini eksik girerseniz program hatalı calışabilir. 
                        <br> <br>
                        Fakat ögrenci hakkında bilgileri eksik girerseniz sadece girlen ögrencide hata olur.
                    </p>
                    
                    <a href="yardim.php">Daha fazlası</a>
                    
                </div>
            </div>
        </div>

    </div>
</div>
<hr class="hr-1" >
<script src="js/swiper.min.js"></script>
<script>
    var swiper = new Swiper('.swiper-container', {
      effect: 'coverflow',
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: 'auto',
      coverflowEffect: {
        rotate: 30,
        stretch: 0,
        depth: 500,
        modifier: 1,
        slideShadows : true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });
  </script>
<script src="js/jquery-3.4.1.js"></script>

<script src="js/popper.min.js"></script>

<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>
