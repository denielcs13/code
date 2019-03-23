<?php
error_reporting(0);
$ftp_server = "ftp.mytesting.review";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$ftp_username="tempdbi@mytesting.review";
$ftp_userpass="M#{U9bMv;sOz";
$login = ftp_login($ftp_conn, $ftp_username, $ftp_userpass);
//var_dump($login);
ftp_pasv($ftp_conn, true);

$files = getDirContents('/xampp/htdocs/ciwshop/csvfile/uploads');
foreach($files as $file){
    $foldername =  explode(DIRECTORY_SEPARATOR,$file);
    $table_prefix=$foldername[6];
    $file_name=$foldername[7];

    
$file = "C:/xampp/htdocs/ciwshop/csvfile/uploads/$table_prefix/$file_name";
$fp = fopen($file,"r");
if (ftp_fput($ftp_conn, "../assets/csvfile/$table_prefix/$file_name", $fp, FTP_ASCII))
  {
  echo "Successfully uploaded $file.</br>";
  }
else
  {
  echo "Error uploading $file.";
  }
  
}
ftp_close($ftp_conn); 

function getDirContents($dir, &$results = array()){
    $files = scandir($dir);

    foreach($files as $key => $value){
        $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
        if(!is_dir($path)) {
            $results[] = $path;
        } else if($value != "." && $value != "..") {
            getDirContents($path, $results);
            
        }
    }

    return $results;
}
?>