<?php 

error_reporting(0);
header('Content-Type: text/html; charset=ISO-8859-9');

//tüm veriler icin 
$veriler = array();  

//sınav test icin 
$tstgrpsatir=array();
$testcevaplari=array(); 
$tstgrpadi=array();

//ogrenci islemleri icin 
$ogrno=array();
$ogrtestgrp=array();
$ogradi=array();
$ogrcevap=array();

//ogr puan dizisi
$puanlar=array();



//döngü kısmında yardımcı değikenler
$say1=0;
$say2=0;
$say3=0;
//verileri okuma 
foreach(explode(PHP_EOL, $dosya_oku) as $satir)
{ 
    $veriler[$say1]=($satir);
    $say1++;
}

//txt dosyasindan gelen veri ayistirma 

for ($i=0; $i <count($veriler) ; $i++) 
{   
    $numara = substr($veriler[$i],0,9);
    $konum = strpos($numara,'   ');
    
    if ($konum !== false) 
    {
        $tstgrpsatir[$i]=substr($veriler[$i],0,30);
        $say3=0;
        for ($j=31; $j <strlen($veriler[$i]) ; $j++) { 
            if($veriler[$i][$j]!==" ")
                $say3++;
        }
        $testcevaplari[$i]=substr($veriler[$i],31,$say3);
        $say2++;
        
    }

    else 
    {
        $ogrno[$i]=substr($veriler[$i],0,9);      //9 birimlik ogr no
        $ogrtestgrp[$i]=substr($veriler[$i],9,1); //1 birimlik ogr test grupno
        $ogradi[$i]=substr($veriler[$i],10,21);   //20 birimlik ogr isim soyisim
        $ogrcevap[$i]=substr($veriler[$i],31,$say3);
    }
}

    
//txt dosyasindan alinan test kitapçiklarini ayirmak için 

for ($i=0; $i <count($tstgrpsatir); $i++) { 
    for ($j=0; $j <strlen($tstgrpsatir[$i]);  $j++) { 
        if ($tstgrpsatir[$i][$j]!=" ") {
            $tstgrpadi[$i]=$tstgrpsatir[$i][$j];
        }
    }
}

//puan  islemleri icin for

for ($j=0; $j <count($testcevaplari); $j++) 
{ 
    for ($i=$say2; $i <=count($ogrcevap); $i++) 
    { 
        
        if ($ogrtestgrp[$i]==$tstgrpadi[$j]) //grup kontrolü
        {
            $no=array_search($tstgrpadi[$j], $tstgrpadi);

            $puansay=0;

            for ($k=0; $k <strlen($ogrcevap[$i]) ; $k++) { 
                
                if ($testcevaplari[$no][$k]==$ogrcevap[$i][$k]) {
                    $puansay+=100/strlen($testcevaplari[$no]);
                }
            

            }
            if(round($puansay)>100){
                $puanlar[$i]="100";
            }
            else{
                $puanlar[$i]=round($puansay);
            }
          
        }

    }

}

?>