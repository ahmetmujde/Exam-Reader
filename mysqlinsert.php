<?php
    //kayit icin cnn gerekli

    for ($i=0; $i <count($tstgrpadi); $i++) // veri tabani test islemleri icin for
    {   

    $sql = "insert into  test(sinav_no,test_adi,cevaplar)
    values ('".$sinav_no."','".$tstgrpadi[$i]."','".$testcevaplari[$i]."')";

    $result= $conn->prepare($sql);
    $result->execute();

    }

    for ($i=2; $i <=count($ogrtestgrp); $i++) // veri tabani test islemleri icin for
    {   

    $sql = "insert into  ogrtest(sinav_no,ogr_no,ogr_adi,test_grup,ogr_cevap,puan)
    values ('".$sinav_no."','".$ogrno[$i]."','".$ogradi[$i]."','".$ogrtestgrp[$i]."','".$ogrcevap[$i]."','".$puanlar[$i]."')";

    $result= $conn->prepare($sql);
    $result->execute();
        
    }



?>