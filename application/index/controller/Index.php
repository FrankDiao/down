<?php
namespace app\index\controller;


use think\Validate;
class Index extends Base
{
    public function index()
    {
        if(!$this->request->isPost()){
            return $this->fetch('index');
        }

        $data = $this->request->param();
        $ext = explode('.',$data['url']);
        return $this->curl_download($data['url'],$ext[count($ext)-1]);
    }

    function curl_download($url,$ext) {
        $dir = ROOT_PATH.'public'.DS.'static'.DS.'down_file'.DS.time().'.'.$ext;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $file_content = curl_exec($ch);
        if (empty($file_content)){
            echo 'error:'.curl_errno($ch);
            $flag = false;
        }else{
            $flag = true;
        }
        curl_close($ch);
        file_put_contents($dir, $file_content);
        return json(['flag'=>$flag]);
    }
}
