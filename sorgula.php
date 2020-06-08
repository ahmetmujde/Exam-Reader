<?php

if(!empty($_FILES['dosya']))
{
  $path = "optik/";
  $path = $path . basename( $_FILES['dosya']['name']);

  if(move_uploaded_file($_FILES['dosya']['tmp_name'], $path)) {
    $dsyadi="C:\\xampp\\htdocs\\php\\optik\\".basename( $_FILES['dosya']['name']);

  } else{
      echo "Dosya yüklenirken bir hata oluştu, lütfen tekrar deneyin!";
  }
}


if("txt"==substr($dsyadi,-3)) //uzantı kontrol
{
    $dosya_ici = fOpen($dsyadi,"r");

    $dosya_oku = fRead($dosya_ici,fileSize($dsyadi));
    
    include("ayar.php");

if(!empty($tstgrpadi)){

    //şimdiki tarih ve 2 basamaklı rasgele bir sayi ile kullanıcıya tekrar girmesi icin sifre veriyoruz...
    $rdm_sayi =  strtotime(date("Y-m-d H:i:s")).rand(10,99); 
    $sinav_no = substr($rdm_sayi,1,11);
    settype($sinav_no,"string");

    include("mysqlcnn.php");
    
    $sql = "select count(*) as toplam from test where sinav_no = '".$sinav_no."'"; //ayni sayi gelmesi durumu engelleme

    $result = $conn->query($sql);
    
    $row = $result->fetch_assoc();

    if($row['toplam']==0)
    {
        include("mysqlinsert.php");       
    }
    
    else{
        header('Location: index.php?script=on');
    }

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="vieport" content="width=device=width,initial=scale=1,shrick=to=fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Optik Sonuclari</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Slabo+27px&display=swap&subset=latin-ext" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/style.css">

</head>
<body>

<!-- Creator : Ahmet Tayyip Mujde -->

<!-- nav menü-->
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar10">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse" id="navbar10">
        <ul class="navbar-nav nav-fill">
                <li class="nav-item active">
                    <a class="navbar-brand text-center" href="index.php"> <i class="fas fa-file-download">&nbsp;&nbsp;</i>OPTIK OKUT  <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a href="yardim.php" class="nav-link">YARDIM</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br>
<br>

<div class="card border-dark " style="max-width: 18rem;">
  <div class="card-header">OPTIK OKUMA BASARILI</div>
  <div class="card-body text-dark">
    <h5 class="card-title">SINAV NUMARANIZ</h5>
    <p class="card-text"><?php echo $sinav_no; ?></p>
  </div>
</div>

<div class="container">
<div class="row">
    <div class="col-md">
    <br>  
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">TEST GRUP ADI </th>
            <th scope="col">TEST CEVAPLARI</th>
            </tr>
        </thead>

        <tbody>
            <tr><?php
            for ($i=0; $i <count($tstgrpsatir); $i++) //test islemleri icin for
            {   
            echo '<th scope="row">'.($i+1).'</th>';
            echo '<td>'.$tstgrpadi[$i].'</td>';
            echo '<td>'.$testcevaplari[$i].'</td></tr>';       
            }
            ?>       
        </tbody>
    </table>
<br><br>
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">OGRENCI NO </th>
            <th scope="col">OGRENCI ADI</th>
            <th scope="col">TEST GRUP</th>
            <th scope="col">OGRENCI TEST CEVAPLARI</th>
            <th scope="col">NOTU</th>
            </tr>
        </thead>

        <tbody>
            <tr><?php
            for ($j=$say2; $j <= count($ogrtestgrp); $j++)
            { 
                echo '<th scope="row">'.($j-$say2+1).'</th>';
                echo '<td>'.$ogrno[$j].'</td>';
                echo '<td>'.$ogradi[$j].'</td>';
                echo '<td>'.$ogrtestgrp[$j].'</td>';
                echo '<td>'.$ogrcevap[$j].'</td>';
                echo '<td>'.$puanlar[$j].'</td></tr>';    
            }
            ?>        
        </tbody>
    </table>
    </div>
   </div>
</div>

<h1><?php 

echo $say3."<br>".$say4; 

?></h1>

<script src="js/jquery-3.4.1.js"></script>

<script src="js/popper.min.js"></script>

<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>

<?php
unlink($dsyadi); //kopyanılan dosyayı silmek icin
}
    else{
        unlink($dsyadi); //kopyanılan dosyayı silmek icin
        echo"<script>alert('Hatali dosya !! Yonlendiriliyor..')</script>";
        header('Refresh:0, url= index.php#error ');
        
    }
}

else
{
    header('Location: index.php');
}
    
?>