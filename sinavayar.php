
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

<style> 
input {
  width: 3%;
}
</style>
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
            <?php

                $sinav_no=$_GET["sinavno"];

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
                            echo '<td>';
                            for($i=0; $i<strlen($row["cevaplar"]); $i++)
                            {   
                                echo ($i+1).'<input type="text" name="cvp'.$i.'" value="'.$row["cevaplar"][$i].'">';
                            }
                            echo '</td></tr>';
                        }  
                    }
                    ?>
                      
            </tbody> 
        </table>
    </div>
  </div>
</div>
