<?php
/********************************************************
 *  Roza Wiatrow
 *  Autor: Stacje-Pogody.pl
 *  WWW: http://stacje-pogody.pl
 *  Utworzone (dd-mm-rrrr): 19-05-2012
 ********************************************************
 *  Informacja o licencji: Skrypt jest darmowy
 *  License Information: This script is freeware
 ********************************************************/

function pozycja_tekstu($obrazek,$tekst,$font,$x,$y,$kolor)
{
   $dlugosc_tekstu=strlen($tekst)*imagefontwidth($font);

   $pozycja_x = ceil($x-($dlugosc_tekstu/2));
   $pozycja_y = ceil($y-(imagefontheight($font)/2));

   imagestring($obrazek, $font, $pozycja_x, $pozycja_y, $tekst, $kolor);
}

if(!isset($_GET['w']))
{
  exit;
}

$kat = (int) $_GET['w'];

if($kat>360)
{
  $kat=360;
}
elseif($kat<0)
{
  $kat=0;
}

$wskaznik='kompas_wskaznik.png';
$tlo_obrazu='kompas_tlo.png';

$obr_tlo=imagecreatefrompng($tlo_obrazu);
$obr_wsk=imagecreatefrompng($wskaznik);

$szerokosc= imagesx($obr_wsk);
$wysokosc = imagesy($obr_wsk);

$obr_wsk = imagerotate($obr_wsk, (360-$kat), imagecolorallocate($obr_tlo, 255,255,255));
#$obr_wsk = imagerotate($obr_wsk, (360-$kat), 0);
#imagealphablending($obr_wsk, false);
#imagesavealpha($obr_wsk, true);
#imagefill($tlo_obrazu , 0,0 , imagecolorallocate($img, 0,0,0));

$nowa_szerokosc = imagesx($obr_wsk);
$nowa_wysokosc = imagesy($obr_wsk);

$obr_nowy = imagecreatetruecolor($szerokosc, $wysokosc);
imagefill($obr_nowy, 0, 0, imagecolorallocatealpha($obr_nowy, 0, 0, 0, 127));

imagecopyresampled($obr_nowy, $obr_wsk, 0, 0, ($nowa_szerokosc-$szerokosc)/2, (($nowa_wysokosc-$wysokosc)/2), $szerokosc, $wysokosc, $szerokosc, $wysokosc);
imagedestroy($obr_wsk);

imagecopyresampled($obr_tlo,$obr_nowy,0, 0,0,0,$szerokosc, $wysokosc, $szerokosc, $wysokosc);
imagedestroy($obr_nowy);

$kolor['bialy'] = imagecolorallocate($obr_tlo, 255,255,255);
#pozycja_tekstu($obr_tlo,$kat.html_entity_decode('&#176;'),5,$szerokosc/2,$wysokosc/2,$kolor['bialy']);
pozycja_tekstu($obr_tlo,$kat,5,$szerokosc/2,$wysokosc/2,$kolor['bialy']);
#pozycja_tekstu($obr_tlo,'',5,$szerokosc/2,$wysokosc/2,$kolor['bialy']);

imagesavealpha($obr_tlo, true);

header('Content-type: image/png');
imagepng($obr_tlo);

imagedestroy($obr_tlo);

?>