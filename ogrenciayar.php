
<?PHP   include("mysqlcnn.php"); ob_start();
        header('Content-Type: text/html; charset=ISO-8859-9');
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

<style> 
.uzunluk {
  width: 3%;
  padding-left:6px;
  margin:6px 6px 6px 0px;
  border-radius:4px;
  font-style:italic;
  border-color:#2EB32E;

}
.cevapEkle{
    background-color:#75FF75;
    color:white;
    border-radius:0 5px 5px 0;
    text-align:center;
    line-height:1.2;
    padding:1px;
    
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form method="post" name="" id="form1">
                <?php
                    $sinav_no=$_GET["sinavno"];
                    
                    echo '<input name="sinavno" type="hidden" value="'.$sinav_no.'">';

                    $sql = "select ogr_no,ogr_adi,test_grup,ogr_cevap from ogrtest where sinav_no ='".$sinav_no."' ORDER BY test_grup ASC";

                    $result = $conn->query($sql);

                    //Ögrenci teslerini yazdırma

                    if ($result->num_rows > 0) { ?>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">OGR NO</th>
                                <th scope="col">OGR ADI</th>
                                <th scope="col">GRUP NO</th>
                                <th scope="col">CEVAPLAR</th>
                                <th scope="col">CEVAP EKLE</th>
                                </tr>
                            </thead>
                        <tbody>
                            <tr>
                            <?php
                        //kod girisi ile test verilerini Yazdırma
                            
                        while($row = $result->fetch_assoc()) {
                            
                            echo '<td scope="row">'.$row["ogr_no"].'</td>';
                            echo '<td>'.$row["ogr_adi"].'</td>';
                            echo '<td>'.$row["test_grup"].'</td>';
                            echo '<td>';
                            for($i=0; $i<strlen($row["ogr_cevap"]); $i++)
                            {   
                                echo ($i+1).'-<input class="uzunluk" type="text" name="'.$row["ogr_no"].'[]" value="'.$row["ogr_cevap"][$i].'">';
                            }
                            echo '<div id="alan'.$row["ogr_no"].'"/></td>';
                            echo '<td>
                                    <div class="d-flex justify-content-start">
                                    <input style="width:80px;" type="text" id="member'.$row["ogr_no"].'" name="member'.$row["ogr_no"].'" value="">
                                    <a href="#" class="cevapEkle" id="cevapekle'.$row["ogr_no"].'" onclick="ekle'.$row["ogr_no"].'()">Cevap Ekle</a>
                                    </div>
                                  </td></tr>';
                            /**java script işlemleri */

                            echo '<script >
                            function ekle'.$row["ogr_no"].'(){
                                      var number = document.getElementById("member'.$row["ogr_no"].'").value;
                                      var alan = document.getElementById("alan'.$row["ogr_no"].'");
                                      while (alan.hasChildNodes()) {
                                          alan.removeChild(alan.lastChild);
                                      }

                                      for (i='.strlen($row["ogr_cevap"]).';i<'.strlen($row["ogr_cevap"]).'+Number(number);i++){
                                          alan.appendChild(document.createTextNode((i+1)));
                                          var input = document.createElement("input");
                                          input.type = "text";
                                          input.name ="'.$row["ogr_no"].'[]";
                                          input.className="uzunluk";
                                          input.style="width:3%";
                                          alan.appendChild(input);
                                      }
                                  }
                          </script>';
                        }  
                    }
                    ?>
                    
            </tbody> 
        </table>
        

        </br>
        <div class="d-flex justify-content-center">
            <button type="submit" form="form1" name="kaydet" class="btn btn-primary btn-lg">KAYDET</button>
        </div>
        </form>
        <br>
        <br>
        

          <?php
        
            if(isset($_POST['kaydet']))
            {   
                // test kitapçıklarını günceleme 

                ECHO 'SELAM';

                $cevaplar="";

                $sinav_no=$_POST["sinavno"];

                $sql = "select ogr_no,ogr_adi,test_grup,ogr_cevap from ogrtest where sinav_no ='".$sinav_no."'";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) { 
                    while($row = $result->fetch_assoc()) {
                        foreach($_POST[$row["ogr_no"]] as $i) {
                            
                            $cevaplar .= $i;                            
                        }
                        echo $cevaplar;
                        /*
                        $kod = 'update test set cevaplar="'.$cevaplar.'" where test_adi="'.$row["test_adi"].'" and sinav_no="'.$sinav_no.'"';
                        $isle= $conn->prepare($kod);
                        $isle->execute();*/
                        $cevaplar="";

                    }
                }
                
                $url= "ogrenciayar.php?sinavno=$sinav_no";
                header("Location:$url");
                ob_end_flush();
            }

        ?>                    
    </div>
</div>
