<?php
function actionUpload()
{
    if ($_POST) {
        $url = Yii::$app->params['imageUploadPath'];
        //
        $path = $_SERVER['DOCUMENT_ROOT'];
        /*
        print_r($_FILES);
        exit;
        */
        //$filename = $path."/232.jpg";
        //upload tmp
        $tmpname = $_FILES['filedata']['name'];
        $tmpfile = $_FILES['filedata']['tmp_name'];
        $tmpType = $_FILES['filedata']['type'];
        $fileType = Yii::$app->request->post('fileType');
        $target=Yii::$app->params['imageUploadPath'];
        if (!function_exists('curl_file_create')) {
            $cfile = $this->curl_file_create($tmpfile,$tmpType,$tmpname);
        }else  $cfile = curl_file_create($tmpfile,$tmpType,$tmpname);
        $imgdata = array('filedata' => $cfile,'fileType'=>$fileType);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $target);
        curl_setopt($curl, CURLOPT_USERAGENT,'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
        curl_setopt($curl, CURLOPT_HTTPHEADER,array('User-Agent: Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15','Referer: http://someaddress.tld','Content-Type: multipart/form-data'));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true); // enable posting
        curl_setopt($curl, CURLOPT_POSTFIELDS, $imgdata); // post images
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // if any redirection after upload
        $r = curl_exec($curl);
        curl_close($curl);
        echo $r;exit;
    }
}

function curl_file_create($filename, $mimetype = '', $postname = '') {
    return "@$filename;filename="
    . ($postname ?: basename($filename))
    . ($mimetype ? ";type=$mimetype" : '');
}

/**
 * curl 请求 
 */
function curlrequest($url,$data,$method='post'){
    $fields_string = http_build_query ( $data, '&' );
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_USERAGENT,'Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15');
    curl_setopt($curl, CURLOPT_HTTPHEADER,array('User-Agent: Opera/9.80 (Windows NT 6.2; Win64; x64) Presto/2.12.388 Version/12.15','Referer: http://someaddress.tld','Content-Type: multipart/form-data'));
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); // stop verifying certificate
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true); // enable posting
    curl_setopt($curl, CURLOPT_POSTFIELDS, $fields_string); // post images
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); // if any redirection after upload
    $r = curl_exec($curl);
    curl_close($curl);
    return $r;
}