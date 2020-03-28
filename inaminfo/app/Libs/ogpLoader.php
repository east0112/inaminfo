<?php
namespace App\Libs;

class ogpLoader
{
    private $url;
    private $ogp;
    function __construct($url){
        $this->url = $url;
    }

    public function getOGP(){
        return ($this->getParamOGP()) ? $this->ogp : false;
    }

    private function getParamOGP(){
        $html = file_get_contents($this->url);
        if(preg_match_all( "<meta property=\"og:([^\"]+)\" content=\"([^\"]+)\">", $html, $ogpList )){
            if (is_array($ogpList) && isset($ogpList[1])) {
                $ogpResult = array();
                for ($i = 0; $i < count($ogpList[1]); $i++) {
                    $ogpResult[$ogpList[1][$i]] = $ogpList[2][$i];
                }
                $this->ogp = $ogpResult;
                return true;
            }
        }
            return false;
    }

}