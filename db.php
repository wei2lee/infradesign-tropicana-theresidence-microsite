<?php
include_once "dbconn.php";

$result = Database::getInstance()->query("SELECT name, import_datetime FROM combined_registrations where project = 'Tropicana The Residences' order by import_datetime desc");
$result2 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences'");
$result3 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%selangor%' or address2 like '%selangor%' or address3 like '%selangor%'");
$result4 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%kuala lumpur%' or address2 like '%kuala lumpur%' or address3 like '%kuala lumpur%' or address1 like '%kl%' or address2 like '%kl%' or address3 like '%kl%'");
$result5 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%pahang%' or address2 like '%pahang%' or address3 like '%pahang%'");
$result6 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%negeri sembilan%' or address2 like '%negeri sembilan%' or address3 like '%negeri sembilan%'");
$result7 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%johor%' or address2 like '%johor%' or address3 like '%johor%' or address1 like '%jb%' or address2 like '%jb%' or address3 like '%jb%'");
$result8 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%melaka%' or address2 like '%melaka%' or address3 like '%melaka%'");
$result9 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%putrajaya%' or address2 like '%putrajaya%' or address3 like '%putrajaya%'");
$result10 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%penang%' or address2 like '%penang%' or address3 like '%penang%' or address1 like '%pinang%' or address2 like '%pinang%' or address3 like '%pinang%'");
$result11 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%kedah%' or address2 like '%kedah%' or address3 like '%kedah%'");
$result12 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%perlis%' or address2 like '%perlis%' or address3 like '%perlis%'");
$result13 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%perak%' or address2 like '%perak%' or address3 like '%perak%'");
$result14 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%sabah%' or address2 like '%sabah%' or address3 like '%sabah%'");
$result15 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%sarawak%' or address2 like '%sarawak%' or address3 like '%sarawak%'");
$result16 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%labuan%' or address2 like '%labuan%' or address3 like '%labuan%'");
$result17 = Database::getInstance()->query("SELECT country, count(*) as 'count' FROM combined_registrations where project = 'Tropicana The Residences' group by country order by country");

$result19 = Database::getInstance()->query("SELECT MONTHNAME(import_datetime) AS Month, YEAR(import_datetime) AS Year, (format(count(*),0)) AS 'Total Registrants' FROM combined_registrations where project = 'Tropicana The Residences' GROUP BY Month, Year ORDER BY import_datetime DESC");

$result20 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Kajang%' or address2 like '%Kajang%' or address3 like '%Kajang%'");
$result21 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Semenyih%' or address2 like '%Semenyih%' or address3 like '%Semenyih%'");
$result22 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Serdang%' or address2 like '%Serdang%' or address3 like '%Serdang%'");
$result23 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Cheras%' or address2 like '%Cheras%' or address3 like '%Cheras%'");
$result24 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Ampang%' or address2 like '%Ampang%' or address3 like '%Ampang%'");
$result25 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Puchong%' or address2 like '%Puchong%' or address3 like '%Puchong%'");
$result26 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Old Klang Road%' or address2 like '%Old Klang Road%' or address3 like '%Old Klang Road%'");
$result27 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Bangsar%' or address2 like '%Bangsar%' or address3 like '%Bangsar%'");
$result28 = Database::getInstance()->query("SELECT * FROM combined_registrations where project = 'Tropicana The Residences' and address1 like '%Petaling Jaya%' or address2 like '%Petaling Jaya%' or address3 like '%Petaling Jaya%'");


//$result18 = Database::getInstance()->query("Delete from combined_registrations where project = 'Tropicana The Residences' and name like '%http%' or address1 like '%http%' or address2 like '%http%' or address3 like '%http%' or occupation like '%http%' or remarks like '%http%'"); 



$date = date('D, d F Y');
$count = mysql_num_rows($result);
$count2 = mysql_num_rows($result2);
$count3 = mysql_num_rows($result3);
$count4 = mysql_num_rows($result4);
$count5 = mysql_num_rows($result5);
$count6 = mysql_num_rows($result6);
$count7 = mysql_num_rows($result7);
$count8 = mysql_num_rows($result8);
$count9 = mysql_num_rows($result9);
$count10 = mysql_num_rows($result10);
$count11 = mysql_num_rows($result11);
$count12 = mysql_num_rows($result12);
$count13 = mysql_num_rows($result13);
$count14 = mysql_num_rows($result14);
$count15 = mysql_num_rows($result15);
$count16 = mysql_num_rows($result16);
$count20 = mysql_num_rows($result20);
$count21 = mysql_num_rows($result21);
$count22 = mysql_num_rows($result22);
$count23 = mysql_num_rows($result23);
$count24 = mysql_num_rows($result24);
$count25 = mysql_num_rows($result25);
$count26 = mysql_num_rows($result26);
$count27 = mysql_num_rows($result27);
$count28 = mysql_num_rows($result28);


echo "<h2><u>Tropicana The Residences</u></h2><h3>Total registrants accumulated until $date :</h3>
<h4>$count2 registrants in total</h4>";

if (!$result) {
    die('Invalid query: ' . mysql_error());
}

if (mysql_num_rows($result19) >= 1){
// Print the column names as the headers of a table
//echo "Total Registrants accumulated until $date : $count <br /><br />";
echo "<table  border='1' cellpadding='10'> <tr>";
for($i = 0; $i < mysql_num_fields($result19); $i++) {
    $field_info = mysql_fetch_field($result19, $i);
    echo "<th>{$field_info->name}</th>";
}

// Print the data
while($row4 = mysql_fetch_row($result19)) {
    echo "<tr>";
    foreach($row4 as $_column) {
        echo "<td align='center'>{$_column}</td>";
    }
    echo "</tr>";
}

echo "</table><br />";

}

echo "<strong>Total count group by Location:-</strong><br />";
echo "Kajang : $count20 registrants <br />";
echo "Semenyih : $count21 registrants <br />";
echo "Serdang : $count22 registrants <br />";
echo "Cheras : $count23 registrants <br />";
echo "Ampang : $count24 registrants <br />";
echo "Puchong : $count25 registrants <br />";
echo "Old Klang Road : $count26 registrants <br />";
echo "Bangsar : $count27 registrants <br />";
echo "Petaling Jaya : $count28 registrants <br /><br />";



echo "<strong>Total count group by State:-</strong><br />";
echo "Selangor : $count3 registrants <br />";
echo "Kuala Lumpur : $count4 registrants <br />";
echo "Pahang : $count5 registrants <br />";
echo "Negeri Sembilan : $count6 registrants <br />";
echo "Johor : $count7 registrants <br />";
echo "Melaka : $count8 registrants <br />";
echo "Putrajaya : $count9 registrants <br />";
echo "Penang : $count10 registrants <br />";
echo "Kedah : $count11 registrants <br />";
echo "Perlis : $count12 registrants <br />";
echo "Perak : $count13 registrants <br />";
echo "Sabah : $count14 registrants <br />";
echo "Sarawak : $count15 registrants <br />";
echo "Labuan : $count16 registrants <br /><br />";

if (mysql_num_rows($result17) >= 1){
// Print the column names as the headers of a table
//echo "Total Registrants accumulated until $date : $count <br /><br />";
echo "<table  border='1' cellpadding='10'> <tr>";
for($i = 0; $i < mysql_num_fields($result17); $i++) {
    $field_info = mysql_fetch_field($result17, $i);
    echo "<th>{$field_info->name}</th>";
}

// Print the data
while($row4 = mysql_fetch_row($result17)) {
    echo "<tr>";
    foreach($row4 as $_column) {
        echo "<td align='center'>{$_column}</td>";
    }
    echo "</tr>";
}

echo "</table><br />";

}


if (mysql_num_rows($result) >= 1){
// Print the column names as the headers of a table
//echo "Total Registrants accumulated until $date : $count <br /><br />";
echo "<table  border='1' cellpadding='10'> <tr>";
for($i = 0; $i < mysql_num_fields($result); $i++) {
    $field_info = mysql_fetch_field($result, $i);
    echo "<th>{$field_info->name}</th>";
}

// Print the data
while($row4 = mysql_fetch_row($result)) {
    echo "<tr>";
    foreach($row4 as $_column) {
        echo "<td align='center'>{$_column}</td>";
    }
    echo "</tr>";
}

echo "</table><br />";

}

?>

