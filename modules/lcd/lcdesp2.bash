#!/bin/bash 
#IP EASYESP
ip=192.168.2.106
#LICZBA WIERSZY
rows=2;
#TYP WYŚWIETLACZA lcd DLA LCD / oled DLA OLED
disp_type=lcd;
#ILOŚĆ KOLUMN
column=16;
#Tempo przewijania w sekundach.
#Ilość czujników do wyświetlenia x czas x 1,6 musi być mniejsza od 60
#lub ustawiamy większy czas i dodajemy ścieżkę dostępu do pliku cron/5 zamiast cron/1
scroll=5;
#Numer wiersza od którego będą wyświetlane dane. Możemy sobie np; w pierwszym wierszu wstawić godzinę w ustawieniach EasyESP
#a czjniki wyświetlać od drugiego
trow=1;


#///////////////////////////////////////////////
column0=1;
rows=$(( $rows - 1 ));
rowstart=$trow;
dir=$( cd "$( dirname "$0" )" && cd ../../ && pwd )
temp_scale=`sqlite3 -cmd ".timeout 2000" $dir/dbf/nettemp.db "SELECT temp_scale FROM settings"`
check() {
for line in `sqlite3 -cmd ".timeout 2000" $dir/dbf/nettemp.db "SELECT name,tmp,type FROM sensors WHERE lcd='on' ORDER BY position ASC, id ASC "| sed 's/ /_/g'`; 
   
       do
      line2=$(echo $line2 |sed 's/ //g')
      name=$(echo $line | awk 'BEGIN {FS="|"}{print $1}' | sed 'y/ęóąśćłżź/eoasclzz/')
      tmp=`echo $line | awk 'BEGIN {FS="|"}{print $2}'`
      type=$(echo $line | awk 'BEGIN {FS="|"}{print $3}' | sed 's/|/ /g' | sed 's/press/hPa/g' | sed 's/temp/'$temp_scale'/g' | sed 's/humid/%/g' | sed 's/volt/V/g' | sed 's/amps/A/g' | sed 's/watt/W/g' | sed 's/water/m3/g' | sed 's/gas/m3/g' | sed 's/elec/kWh/g' | sed 's/host/ms/g' | sed 's/air/ug\/m^3/g')
      count=$(echo "$tmp$type" | wc -m )
      count1=$(echo "$name" | wc -m )
      column1=$(($column - ($count1 + $count) + 1 ))
      separate=`for i in $(seq 1 $column1); do echo -n '%20'; done`
      curl --connect-timeout 2 'http://'$ip'/control?cmd='$disp_type','$trow','$column0','$name''$separate''$tmp'%20'$type'';
       echo 'http://'$ip'/control?cmd='$disp_type','$trow','$column0','$name''$separate''$tmp'%20'$type'';
if [ $trow -le  $rows ]; then
   trow=$(( $trow + 1 ))
   sleep $scroll
   else
   sleep $scroll
   trow=$rowstart
   #break 2;
            fi
      
done
}
check
