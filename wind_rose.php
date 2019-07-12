<?php
$root=$_SERVER["DOCUMENT_ROOT"];

$db = new PDO("sqlite:$root/dbf/nettemp.db") or die ("cannot open database");
$sth = $db->prepare("select * from sensors where type='wind';");
$sth->execute();
$result = $sth->fetchAll();
$numRows = count($result);
?>
<?php if ( $numRows > '0' ) { ?>
<?php /*
<!--
<div class="grid-item hs" >
<div class="panel panel-default">
<div class="panel-heading">Wind status</div>
-->
*/?>
<table class="table table-hover condensed small">
<?php
foreach ( $result as $a) {
?>
    <tr>
	<td >
	    <img src="tmp/meteo/roza.php?w=<?php echo $a['tmp']?>">
	</td>
    </tr>
    <tr>
	<td align="center">
<style type="text/css">
@font-face{
font-family: digitalgream;
            src:url(tmp/digitaldream.ttf);
}
</style>
<script type="text/javascript">

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
 function timedMsg()
  {
    var t=setInterval("change_time();",1000);
  }
 function change_time()
 {
   var d = new Date();
   var curr_hour = addZero(d.getHours());
   var curr_min = addZero(d.getMinutes());
   var curr_sec = addZero(d.getSeconds());
   if(curr_hour > 24)
     curr_hour = curr_hour - 24;
    document.getElementById('Hour').innerHTML =curr_hour+':';
    document.getElementById('Minut').innerHTML=curr_min+':';
    document.getElementById('Second').innerHTML=curr_sec;

   
var dd = d.getDate();
var mm = d.getMonth()+1;
var yyyy = d.getFullYear();
if(dd<10) {
    dd='0'+dd
}
if(mm<10) {
    mm='0'+mm
}
var today = dd+'/'+mm+'/'+yyyy;
 document.getElementById('dat').innerHTML=today;
 
 }
timedMsg();   
</script>
<div>
 <table align="center" border=0>
   <tr style="font-size:250%;font-family: 'digitalgream';">
  <td id="Hour" ></td>
  <td id="Minut"></td>
  <td id="Second"></td>
  <tr>
  <tr>
  <td colspan=3 align="center" style="font-size:100%;font-family: 'digitalgream';" id="dat"></td>
  </tr>
 </table>
<?php
function imieniny(){

        $data = date("m-d");

        $imieniny = array(

        //STYCZEN
                                                
        "01-01" => "Mieszka, Mieczysława, Marii",
        "01-02" => "Izydora, Bazylego, Grzegorza",
        "01-03" => "Arlety, Genowefy, Danuty",
        "01-04" => "Tytusa, Anieli, Eugeniusza",
        "01-05" => "Hanny, Szymona, Edwarda",
        "01-06" => "Kacpra, Melchiora, Baltazara",
        "01-07" => "Juliana, Lucjana, Rajmunda",
        "01-08" => "Seweryna, Mścisława, Juliusza",
        "01-09" => "Marceliny, Marianny, Juliana",
        "01-10" => "Wilhelma, Dobrosława, Danuty",
        "01-11" => "Honoraty, Teodozjusza, Matyldy",
        "01-12" => "Grety, Arkadiusza, Rajmunda",
        "01-13" => "Bogumiły, Weroniki, Hilarego",
        "01-14" => "Feliksa, Domosława, Niny",
        "01-15" => "Pawła, Arnolda, Izydora",
        "01-16" => "Marcelego, Włodzimierza, Waldemara",
        "01-17" => "Antoniego, Rościsława, Jana",
        "01-18" => "Piotra, Małgorzaty",
        "01-19" => "Henryka, Mariusza, Marty",
        "01-20" => "Fabiana, Sebastiana",
        "01-21" => "Agnieszki, Jaros?awa",
        "01-22" => "Anastazego, Wincentego",
        "01-23" => "Ildefonsa, Rajmunda",
        "01-24" => "Felicji, Franciszka, Rafała",
        "01-25" => "Pawła, Miłosza, Elwiry",
        "01-26" => "Tymoteusza, Michała, Tytusa",
        "01-27" => "Przybysława, Anieli, Jerzego",
        "01-28" => "Walerego, Radomira, Tomasza",
        "01-29" => "Zdzisława, Franciszka, Józefa",
        "01-30" => "Macieja, Martyny, Teofila",
        "01-31" => "Marceli, Ludwiki, Jana",

        //LUTY

        "02-01" => "Brygidy, Ignacego, Seweryna",
        "02-02" => "Marii, Miloslawa",
        "02-03" => "Blazeja, Oskara",
        "02-04" => "Andrzeja, Weroniki, Joanny",
        "02-05" => "Agaty, Adelajdy",
        "02-06" => "Doroty, Bogdana, Pawla",
        "02-07" => "Ryszarda, Teodora, Romana",
        "02-08" => "Hieronima, Sebastiana, Ireny",
        "02-09" => "Apolonii, Eryki, Cyryla",
        "02-10" => "Elwiry, Jacka, Scholastyki",
        "02-11" => "Lucjana, Olgierda",
        "02-12" => "Eulalii, Radoslawa, Modesta",
        "02-13" => "Grzegorza, Katarzyny",
        "02-14" => "Cyryla, Metodego, Walentego",
        "02-15" => "Jowity, Faustyna, Zygfryda",
        "02-16" => "Danuty, Julianny, Daniela",
        "02-17" => "Aleksego, Zbigniewa, Lukasza",
        "02-18" => "Szymona, Konstancji, Flawiana",
        "02-19" => "Arnolda, Konrada, Marcelego",
        "02-20" => "Leona, Ludomira, Zenobiusza",
        "02-21" => "Eleonory, Fortunata, Roberta",
        "02-22" => "Marty, Malgorzaty, Piotra",
        "02-23" => "Romany, Damiana, Polikarpa",
        "02-24" => "Macieja, Bogusza, Sergiusza",
        "02-25" => "Wiktora, Cezarego",
        "02-26" => "Miroslawa, Aleksandra",
        "02-27" => "Gabriela, Anastazji",
        "02-28" => "Romana, Ludomira, Lecha",
        "02-29" => "Lecha, Lutoslawa",

        //MARZEC

        "03-01" => "Antoniny, Radoslawa, Dawida",
        "03-02" => "Heleny, Halszki, Pawla",
        "03-03" => "Maryny, Kunegundy, Tycjana",
        "03-04" => "Lucji, Kazimierza, Eugeniusza",
        "03-05" => "Adriana, Fryderyka, Teofila",
        "03-06" => "Rózy, Jordana, Agnieszki",
        "03-07" => "Tomasza, Perpetuy, Felicyty",
        "03-08" => "Beaty, Wincentego, Jana",
        "03-09" => "Franciszki, Brunona",
        "03-10" => "Cypriana, Marcela, Aleksandra",
        "03-11" => "Ludoslawa, Konstantyna, Benedykta",
        "03-12" => "Grzegorza, Justyna, Alojzego",
        "03-13" => "Bozeny, Krystyny",
        "03-14" => "Leona, Matyldy, Lazarza",
        "03-16" => "Longina, Klemensa, Ludwiki",
        "03-16" => "Izabeli, Oktawii, Hilarego",
        "03-17" => "Patryka, Zbigniewa, Gertrudy",
        "03-18" => "Cyryla, Edwarda, Boguchwaly",
        "03-19" => "Józefa, Bogdana",
        "03-20" => "Klaudii, Eufemii, Maurycego",
        "03-21" => "Lubomira, Benedykta",
        "03-22" => "Katarzyny, Boguslawa",
        "03-23" => "Pelagii, Oktawiana, Feliksa",
        "03-24" => "Marka, Gabriela, Katarzyny",
        "03-25" => "Marioli, Wieczyslawa, Ireneusza",
        "03-26" => "Larysy, Emanyela, Teodora",
        "03-27" => "Lidii, Ernesta",
        "03-28" => "Anieli, Sykstusa, Jana",
        "03-29" => "Wiktoryna, Helmuta, Eustachego",
        "03-30" => "Anieli, Kwiryna, Leonarda",
        "03-31" => "Beniamina, Dobromierza, Leonarda",

        //KWIECIEN

        "04-01" => "Teodory, Grazyny, Ireny",
        "04-02" => "Wladyslawa, Franciszka, Teodozji",
        "04-03" => "Ryszarda, Pankracego, Ingi",
        "04-04" => "Izydora, Waclawa",
        "04-05" => "Ireny, Wincentego",
        "04-06" => "Izoldy, Celestyna, Wilhelma",
        "04-07" => "Rufina, Celestyna, Jana",
        "04-08" => "Cezaryny, Dionizego, Julii",
        "04-09" => "Marii, Dymitra, Heliodora",
        "04-10" => "Michala, Makarego",
        "04-11" => "Filipa, Leona",
        "04-12" => "Juliusza, Luboslawa, Zenona",
        "04-13" => "Przemyslawa, Hermenegildy, Marcina",
        "04-14" => "Bereniki, Waleriana, Justyny",
        "04-15" => "Ludwiny, Waclawy, Anastazji",
        "04-16" => "Kseni, Cecylii, Bernardety",
        "04-17" => "Rudolfa, Roberta",
        "04-18" => "Boguslawy, Apoloniusza",
        "04-19" => "Adolfa, Tymona, Leona",
        "04-20" => "Czeslawa, Agnieszki, Mariana",
        "04-21" => "Anzelma, Bartosza, Feliksa",
        "04-22" => "Kai, Leonii, Sotera",
        "04-23" => "Jerzego, Wojciecha",
        "04-24" => "Horacego, Feliksa, Grzegorza",
        "04-25" => "Marka, Jaroslawa, Wasyla",
        "04-26" => "Marzeny, Klaudiusza, Marii",
        "04-27" => "Zyty, Teofila, Felicji",
        "04-28" => "Piotra, Walerii, Witalisa",
        "04-29" => "Rity, Katarzyny, Boguslawa",
        "04-30" => "Mariana, Donaty, Tamary",

        //MAJ

        "05-01" => "Józefa, Jeremiasza, Filipa",
        "05-02" => "Zygmunta, Atanazego, Anatola",
        "05-03" => "Marii, Antoniny",
        "05-04" => "Moniki, Floriana, Wladyslawa",
        "05-05" => "Ireny, Waldemara",
        "05-06" => "Judyty, Jakuba, Filipa",
        "05-07" => "Gizeli, Ludmily, Benedykta",
        "05-08" => "Stanislawa, Lizy, Wiktora",
        "05-09" => "Bozydara, Grzegorza, Karoliny",
        "05-10" => "Izydora, Antoniny, Symeona",
        "05-11" => "Igi, Miry, Wladyslawy",
        "05-12" => "Pankracego, Dominika, Achillesa",
        "05-13" => "Serwacego, Roberta, Glorii",
        "05-14" => "Bonifacego, Dobieslawa, Macieja",
        "05-15" => "Zofii, Nadziei, Izydora",
        "05-16" => "Andrzeja, Jedrzeja, Szymona",
        "05-17" => "Paschalisa, Sławomira, Weroniki",
        "05-18" => "Eryka, Feliksa, Jana",
        "05-19" => "Iwa, Piotra, Celestyna",
        "05-20" => "Bazylego, Bernardyna, Aleksandra",
        "05-21" => "Wiktora, Kryspina, Tymoteusza",
        "05-22" => "Heleny, Wieslawy, Ryty",
        "05-23" => "Iwony, Dezyderego, Kryspina",
        "05-24" => "Joanny, Zuzanny",
        "05-25" => "Grzegorza, Urbana, Magdaleny",
        "05-26" => "Filipa, Pauliny",
        "05-27" => "Augustyna, Juliana, Magdaleny",
        "05-28" => "Jaromira, Justa, Justyny",
        "05-29" => "Magdaleny, Bogumily, Urszuli",
        "05-30" => "Ferdynanda, Karola, Jana",
        "05-31" => "Anieli, Petroneli",

        //CZERWIEC

        "06-01" => "Justyna, Anieli, Konrada",
        "06-02" => "Marianny, Marcelina, Piotra",
        "06-03" => "Leszka, Tamary, Karola",
        "06-04" => "Kwiryny, Franciszka",
        "06-05" => "Waltera, Bonifacego, Walerii",
        "06-06" => "Norberta, Laurentego, Bogumila",
        "06-07" => "Roberta, Wieslawa",
        "06-08" => "Medarda, Maksyma, Seweryna",
        "06-09" => "Pelagii, Dominika, Efrema",
        "06-10" => "Bogumila, Malgorzaty, Diany",
        "06-11" => "Barnaby, Radomila, Feliksa",
        "06-12" => "Janiny, Onufrego, Leona",
        "06-13" => "Lucjana, Antoniego",
        "06-14" => "Bazylego, Elwiry, Michala",
        "06-15" => "Wita, Jolanty",
        "06-16" => "Aliny, Benona, Anety",
        "06-17" => "Laury, Marcjana, Alberta",
        "06-18" => "Marka, Elzbiety",
        "06-19" => "Gerwazego, Protazego",
        "06-20" => "Diny, Bogny, Florentyny",
        "06-21" => "Alicji, Alojzego",
        "06-22" => "Pauliny, Tomasza, Jana",
        "06-23" => "Wandy, Zenona",
        "06-24" => "Jana, Danuty",
        "06-25" => "Lucji, Wilhelma, Doroty",
        "06-26" => "Jana, Pawla",
        "06-27" => "Maryli, Wladyslawa, Cyryla",
        "06-28" => "Leona, Ireneusza",
        "06-29" => "Piotra, Pawla",
        "06-30" => "Emilii, Lucyny",

        //LIPIEC

        "07-01" => "Haliny, Mariana, Marcina",
        "07-02" => "Jagody, Urbana, Marii",
        "07-03" => "Jacka, Anatola, Tomasza",
        "07-04" => "Odona, Malwiny, Elzbiety",
        "07-05" => "Marii, Antoniego",
        "07-06" => "Gotarda, Dominiki, Lucji",
        "07-07" => "Cyryla, Estery, Metodego",
        "07-08" => "Edgara, Elzbiety, Eugeniusza",
        "07-09" => "Lukrecji, Weroniki, Zenona",
        "07-10" => "Sylwany, Witalisa, Antoniego",
        "07-11" => "Olgi, Kaliny, Benedykta",
        "07-12" => "Jana, Brunona, Bonifacego",
        "07-13" => "Henryka, Kingi, Andrzeja",
        "07-14" => "Ulryka, Bonawentury, Kamila",
        "07-15" => "Henryka, Wlodzimierza, Dawida",
        "07-16" => "Mariki, Benity, Eustachego",
        "07-17" => "Anety, Bogdana, Jadwigi",
        "07-18" => "Erwina, Kamila, Szymona",
        "07-19" => "Wincentego, Wodzislawa, Marcina",
        "07-20" => "Czeslawa, Hieronima, Malgorzaty",
        "07-21" => "Daniela, Diany, Wawrzynca",
        "07-22" => "Marii, Magdaleny",
        "07-23" => "Stwosza, Bogny, Brygidy",
        "07-24" => "Kingi, Krystyny",
        "07-25" => "Walentyny, Krzysztofa, Jakuba",
        "07-26" => "Anny, Miroslawy, Grazyny",
        "07-27" => "Lilii, Julii, Natalii",
        "07-28" => "Aidy, Marceli, Wiktora",
        "07-29" => "Olafa, Marty, Ludmily",
        "07-30" => "Julity, Piotra, Aldony",
        "07-31" => "Ignacego, Lubomira, Heleny",

        //SIERPIE?

        "08-01" => "Nadii, Justyna, Juliana",
        "08-02" => "Kariny, Gustawa, Euzebiusza",
        "08-03" => "Lidii, Augusta, Nikodema",
        "08-04" => "Dominika, Protazego, Jana",
        "08-05" => "Oswalda, Marii, Mariana",
        "08-06" => "Slawy, Jakuba, Oktawiana",
        "08-07" => "Kajetana, Doroty, Sykstusa",
        "08-08" => "Cypriana, Emiliana, Dominika",
        "08-09" => "Romana, Ryszarda, Edyty",
        "08-10" => "Borysa, Filomeny, Wawrzynca",
        "08-11" => "Klary, Zuzanny, Lecha",
        "08-12" => "Innocentego, Lecha, Euzebii",
        "08-13" => "Diany, Hipolita, Poncjana",
        "08-14" => "Alfreda, Euzebiusza, Maksymiliana",
        "08-15" => "Napoleona, Stelii",
        "08-16" => "Rocha, Stefana, Joachima",
        "08-17" => "Zanny, Mirona, Jacka",
        "08-18" => "Ilony, Bronislawa, Heleny",
        "08-19" => "Boleslawa, Juliana",
        "08-20" => "Bernarda, Samuela, Sobieslawa",
        "08-21" => "Joanny, Kazimiery, Piusa",
        "08-22" => "Cezarego, Tymoteusza",
        "08-23" => "Apolinarego, Filipa",
        "08-24" => "Jerzego, Bartosza, Haliny",
        "08-25" => "Luizy, Ludwika, Józefa",
        "08-26" => "Marii, Aleksandra",
        "08-27" => "Cezarego, Józefa, Moniki",
        "08-28" => "Patrycji, Wyszomira, Augustyna",
        "08-29" => "Beaty, Jana, Sabiny, Racibora",
        "08-30" => "Rózy, Szczesnego, Feliksa",
        "08-31" => "Bogdana, Ramony, Rajmunda",

        //WRZESIE?

        "09-01" => "Idziego, Bronislawa",
        "09-02" => "Juliana, Stefana, Wilhelma",
        "09-03" => "Grzegorza, Izabeli, Szymona",
        "09-04" => "Idy, Julianny, Rozalii, Rózy",
        "09-05" => "Doroty, Teodora, Wawrzynca",
        "09-06" => "Beaty, Eugeniusza",
        "09-07" => "Domoslawy, Melchiora, Reginy",
        "09-08" => "Marii, Adrianny, Serafiny",
        "09-09" => "?cibora, Sergiusza, Piotra",
        "09-10" => "Lukasza, Aldony, M?cislawa",
        "09-11" => "Jacka, Prota, Dagny, Hiacynta",
        "09-12" => "Gwidona, Radzimira, Marii",
        "09-13" => "Eugenii, Aureliusza, Jana",
        "09-14" => "Roksany, Bernarda, Cypriana",
        "09-15" => "Albina, Nikodema, Marii",
        "09-16" => "Edyty, Korneliusza, Cypriana",
        "09-17" => "Franciszka, Roberta, Justyna",
        "09-18" => "Irmy, Stanislawa, Ireny",
        "09-19" => "Januarego, Konstancji, Teodora",
        "09-20" => "Filipiny, Eustachego, Euzebii",
        "09-21" => "Jonasza, Mateusza, Hipolita",
        "09-22" => "Tomasza, Maurycego, Joachima",
        "09-23" => "Tekli, Boguslawa, Linusa",
        "09-24" => "Gerarda, Ruperta, Tomiry",
        "09-25" => "Aurelii, Wladyslawa, Kleofasa",
        "09-26" => "Wawrzynca, Kosmy, Damiana",
        "09-27" => "Wincentego, Mirabeli, Justyny",
        "09-28" => "Waclawa, Tymona, Marka",
        "09-29" => "Michala, Gabriela, Rafala",
        "09-30" => "Wery, Honoriusza, Hieronima",

        //PAZDZIERNIK

        "10-01" => "Danuty, Remigiusza, Teresy",
        "10-02" => "Teofila, Dionizego, Slawomira",
        "10-03" => "Teresy, Heliodora, Jana",
        "10-04" => "Rozalii, Edwina, Franciszka",
        "10-05" => "Placyda, Apolinarego",
        "10-06" => "Artura, Brunona",
        "10-07" => "Marii, Marka, Mirelli",
        "10-08" => "Pelagii, Brygidy, Walerii",
        "10-09" => "Amolda, Dionizego, Wincentego",
        "10-10" => "Pauliny, Danieli, Leona",
        "10-11" => "Aldony, Aleksandra, Dobromiry",
        "10-12" => "Eustachego, Maksymiliana, Edwina",
        "10-13" => "Geralda, Edwarda, Honorata",
        "10-14" => "Liwii, Kaliksta, Bernarda",
        "10-15" => "Jadwigi, Teresy, Florentyny",
        "10-16" => "Gawla, Ambrozego",
        "10-17" => "Wiktora, Marity, Ignacego",
        "10-18" => "Juliana, Lukasza",
        "10-19" => "Ziemowita, Jana, Pawla",
        "10-20" => "Ireny, Kleopatry, Jana",
        "10-21" => "Urszuli, Hilarego, Jakuba",
        "10-22" => "Halki, Filipa, Salomei",
        "10-23" => "Marleny, Seweryna, Igi",
        "10-24" => "Rafala, Marcina, Antoniego",
        "10-25" => "Darii, Wilhelminy, Bonifacego",
        "10-26" => "Lucjana, Ewarysta, Damiana",
        "10-27" => "Iwony, Sabiny",
        "10-28" => "Szymona, Tadeusza",
        "10-29" => "Euzebii, Wioletty, Felicjana",
        "10-30" => "Zenobii, Przemyslawa, Edmunda",
        "10-31" => "Urbana, Saturnina, Krzysztofa",

        //LISTOPAD

        "11-01" => "Seweryna, Wiktoryny",
        "11-02" => "Bohdany, Bozydara",
        "11-03" => "Sylwii, Marcina, Huberta",
        "11-04" => "Karola, Olgierda",
        "11-05" => "Elzbiety, Slawomira, Dominika",
        "11-06" => "Feliksa, Leonarda, Ziemowita",
        "11-07" => "Antoniego, Zytomira, Ernesta",
        "11-08" => "Seweryna, Bogdana, Klaudiusza",
        "11-09" => "Aleksandra, Ludwika, Teodora",
        "11-10" => "Leny, Ludomira, Leona",
        "11-11" => "Marcina, Batlomieja, Teodora",
        "11-12" => "Renaty, Witolda, Jozafata",
        "11-13" => "Mateusza, Izaaka, Stanislawa",
        "11-14" => "Rogera, Serafina, Wawrzynca",
        "11-15" => "Alberta, Leopolda",
        "11-16" => "Gertrudy, Edmunda, Marii",
        "11-17" => "Salomei, Grzegorza, Elzbiety",
        "11-18" => "Romana, Klaudyny, Karoliny",
        "11-19" => "Seweryny, Maksyma, Salomei",
        "11-20" => "Anatola, Sedzimira, Rafala",
        "11-21" => "Alberta, Janusza, Konrada",
        "11-22" => "Cecylii, Wszemily, Stefana",
        "11-23" => "Adelii, Klemensa, Felicyty",
        "11-24" => "Flory, Emmy, Chryzogona",
        "11-25" => "Erazma, Katarzyny",
        "11-26" => "Delfiny, Sylwestra, Konrada",
        "11-27" => "Waleriana, Wirgiliusza, Maksyma",
        "11-28" => "Leslawa, Zdzislawa, Stefana",
        "11-29" => "Blazeja, Saturnina",
        "11-30" => "Andrzeja, Maury, Konstantego",

        //GRUDZIEN
        "12-01" => "Natalii, Eligiusza, Edmunda",
        "12-02" => "Balbiny, Bibianny, Pauliny",
        "12-03" => "Franciszka, Ksawerego, Kasjana",
        "12-04" => "Barbary, Krystiana, Jana",
        "12-05" => "Sabiny, Krystyny, Edyty",
        "12-06" => "Mikołaja, Jaremy, Emiliana",
        "12-07" => "Marcina, Ambrożego, Teodora",
        "12-08" => "Marii, Światozara, Makarego",
        "12-09" => "Wiesława Leokadii Joanny",
        "12-10" => "Julii, Danieli, Bogdana",
        "12-11" => "Damazego, Waldemara, Daniela",
        "12-12" => "Dagmary, Aleksandra, Ady",
        "12-13" => "Lucji, Otylii",
        "12-14" => "Alfreda, Izydora, Jana",
        "12-15" => "Niny, Celiny, Waleriana",
        "12-16" => "Albiny, Zdzisławy, Alicji",
        "12-17" => "Olimpii, Lazarza, Floriana",
        "12-18" => "Gracjana, Bogusława, Laurencji",
        "12-19" => "Gabrieli, Dariusza, Eleonory",
        "12-20" => "Bogumi?y, Dominika",
        "12-21" => "Tomis?awa, Seweryna, Piotra",
        "12-22" => "Zenona, Honoraty, Franciszki",
        "12-23" => "Wiktorii, Sławomiry, Jana",
        "12-24" => "Adama, Ewy, Eweliny",
        "12-25" => "Anastazji, Eugenii",
        "12-26" => "Dionizego, Szczepana",
        "12-27" => "Jana, ?anety, Maksyma",
        "12-28" => "Teofilii, Godzisława, Cezarego",
        "12-29" => "Dawida, Tomasza, Dominika",
        "12-30" => "Rainera, Eugeniusza, Irmy",
        "12-31" => "Sylwestra, Melanii, Mariusza",
        );
        
        echo "Imieniny : ";
        echo '<span style="color:blue;">';    
        echo $imieniny["$data"];
        echo '</span>';

};
imieniny();
?>
	</td>
    </tr>
<?php
    }
?>
    </table>
<?php
    }
?>