<?php
                            if(isset($_POST['export'])){

                                include "connection.php";

                            $SQL1 = "SELECT count(*) as NumberofResident, round(monthlyincome,-1) as Income FROM tblresident group by monthlyincome";
                            $SQL2 = "SELECT count(*) as NumberofResident,Zone FROM tblresident r group by r.zone";
                            $SQL3 = "SELECT COUNT( * ) as NumberofResident , Age FROM tblresident GROUP BY age";
                            $SQL4 = "SELECT count(*) as NumberofResident,HighestEducationalAttainment from tblresident group by highesteducationalattainment";

$arrsql = array($SQL1,$SQL2,$SQL3,$SQL4);
$arrhead = array("Resident Income Level","Population per Zone","Age","Resident Educational Attainment");
foreach(array_combine($arrsql,$arrhead) as $value => $headers)  
{  

$header = "$headers\n";
$result ='';
$exportData = mysql_query ($value ) or die ( "Sql error : " . mysql_error( ) );
 
$fields = mysql_num_fields ( $exportData );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $exportData , $i ) . "\t";
}
 
while( $row = mysql_fetch_row( $exportData ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $result .= trim( $line ) . "\n";
}
$result = str_replace( "\r" , "" , $result );
 
if ( $result == "" )
{
    $result = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$result\n\n";

                            }}  
                            ?>