<?php
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "CT_CManager"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}

$request = $_POST['request']; // request

// Get username list
if($request == 1){
 $search = $_POST['search'];

 $query = "SELECT * FROM `ch_cm_product` WHERE `prod_name` LIKE '%".$search."%'";
 $result = mysqli_query($con,$query);
 
 while($row = mysqli_fetch_array($result) ){
  $response[] = array("value"=>$row['prod_id'],"label"=>$row['prod_name']);
//print_r($response);
 }

 // encoding array to json format
 echo json_encode($response);
 exit;
}

// Get details
if($request == 2){
 $pdid = $_POST['proid'];
 $sql = "SELECT * FROM `ch_cm_product` WHERE `prod_id`=".$pdid;
//echo $sql;
 $result = mysqli_query($con,$sql); 

 $prod_arr = array();

 while( $row = mysqli_fetch_array($result) ){
  $pid = $row['prod_id'];
//  $fullname = $row['prod_name']." ".$row['lname'];
  $fullname = $row['prod_name'];
//  $email = $row['email'];
//  $age = $row['age'];
  $price = $row['prod_price'];

  $prod_arr[] = array("id" => $pid, "name" => $fullname,"prc" =>$price);
 }

 // encoding array to json format
 echo json_encode($prod_arr);
 exit;
}
?>
