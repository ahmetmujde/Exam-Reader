<?php

$sinav_no = $_POST["sınavno"];

header('Content-Type: text/html; charset=ISO-8859-9');

include("mysqlcnn.php");
    
$sql = "select count(*) as toplam from test where sinav_no = '".$sinav_no."'"; 

$result = $conn->query($sql);

$row = $result->fetch_assoc();


if($row['toplam']==0){
    echo"<script>alert('";echo $row["toplam"]; echo "Hatali dosya !! Yonlendiriliyor..')</script>";
    header('Refresh:0, url=index.php');
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
            <ul class="navbar-nav nav-fill w-100">
                <li class="nav-item">
                <a class="navbar-brand text-center" href="index.php"> <i class="fas fa-file-download">&nbsp;&nbsp;</i>OPTIK OKUT </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<br><br>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-dark " style="max-width: 18rem;">

                <div class="card-header">VERILERINIZ BULUNDU</div>

                <div class="card-body text-dark">
                    <h5 class="card-title">SINAV NUMARANIZ</h5>
                    <p class="card-text"><?php echo $sinav_no; ?></p>
                </div>
            </div>
            <a href="sinavayar.php?sinavno=<?php echo $sinav_no; ?>" class="btn btn-light btn-lg active" role="button" aria-pressed="true">SINAVI AYARLA</a>
        </div>
    </div>
</div>
<br><br>


<div class="container">
<div class="row">
    <div class="col-md-12">
    <br>
<?php

include("mysqlcnn.php");

$sql = "select ROW_NUMBER() OVER(ORDER BY test_adi ASC) as satir,test_adi,cevaplar from test where sinav_no ='".$sinav_no."'";

$result = $conn->query($sql);

//KİTAPCİK(Test) İSLEMLERİ YAZDIRMA

if ($result->num_rows > 0) { ?>
<table class="table table-striped">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">TEST GRUP ADI </th>
        <th scope="col">TEST CEVAPLARI</th>
        </tr>
    </thead>
        
    <tbody>
        <tr>
        <?php
        //kod girisi ile test verilerini Yazdırma

            while($row = $result->fetch_assoc()) {
                echo '<th scope="row">'.$row["satir"].'</th>';
                echo '<td>'.$row["test_adi"].'</td>';
                echo '<td>'.$row["cevaplar"].'</td></tr>';
            }  
        }
        ?>

    </tbody> 
</table>

<br><br>

<?php

$sql = "select * from ogrtest where sinav_no ='".$sinav_no."'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {?>

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
        <tr>
    <?php
        $i=1;
        while($row = $result->fetch_assoc()) {
            echo '<th scope="row">'.$i.'</th>';
            echo '<td>'.$row["ogr_no"].'</td>';
            echo '<td>'.$row["ogr_adi"].'</td>';
            echo '<td>'.$row["test_grup"].'</td>';
            echo '<td>'.$row["ogr_cevap"].'</td>';
            echo '<td>'.$row["puan"].'</td>
            </tr> ';   
            $i++; 
        }
    ?>
    </tbody>
</table>

<?php }  //if in artan parantezi ?> 

    </div>
  </div>
</div>

<script src="js/jquery-3.4.1.js"></script>

<script src="js/popper.min.js"></script>

<script type="text/javascript" src="js/bootstrap.js"></script>

</body>
</html>
