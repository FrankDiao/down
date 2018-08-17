<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/3/29/029
 * Time: 7:10
 */

date_default_timezone_set("Asia/Shanghai");
if($_POST['submit']){
    $url=$_POST['url']; //取得提交过来的地址http://hu60.cn/wap/0wap/addown.php/fetion_sms.zip
    $time=date("Ymd",time());
    $upload_dir="./upload/";//上传的路径
    $dir=$upload_dir;//创建上传目录
//判断目录是否存在 不存在则创建
    if(!file_exists($upload_dir)){
        mkdir($upload_dir,0777,true);
    }
    $contents=curl_download($url,$dir);
    if($contents){
        echo "下载成功";
    }else{
        echo "下载失败";
    }
}
function curl_download($url, $dir) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $file_content = curl_exec($ch);
    curl_close($ch);
    $downloaded_file = fopen($dir, 'w');
    fwrite($downloaded_file, $file_content);
    fclose($downloaded_file);
    return $file_content;
}