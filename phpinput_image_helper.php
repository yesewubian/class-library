<?php
/**
 * 发送数据流
 * 
**/
$data = file_get_contents('e:/***********.jpg');
$http_entity_body = $data;
$http_entity_type = 'application/x-www-form-urlencoded';
$http_entity_length = strlen($http_entity_body);
$host = '127.0.0.1';
$port = 80;
$path = '接受地址/getimg.php';
$fp = fsockopen($host, $port, $error_no, $error_desc, 30);
if ($fp)
{
    fputs($fp, "POST {$path} HTTP/1.1\r\n");
    fputs($fp, "Host: {$host}\r\n");
    fputs($fp, "Content-Type: {$http_entity_type}\r\n");
    fputs($fp, "Content-Length: {$http_entity_length}\r\n");
    fputs($fp, "Connection: close\r\n\r\n");
    fputs($fp, $http_entity_body . "\r\n\r\n");
 
    $d = '';
    while (!feof($fp))
    {
        $d .= fgets($fp, 4096);
    }
    fclose($fp);
    echo $d;
}

// 接受地址 getimg.php
/**
 *Recieve image data
**/
error_reporting(E_ALL);
function get_contents()
{
    $xmlstr= file_get_contents("php://input");
    $filename=time().'.png';
    if(file_put_contents($filename,$xmlstr))
    {
        echo 'success';
    }
    else
    {
        echo 'failed';
    }
}
get_contents();