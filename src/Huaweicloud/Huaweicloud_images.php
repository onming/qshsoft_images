<?php

namespace Qshsoft\images;

require "./image_sdk/image_tagging.php";
require "./image_sdk/utils.php";
class Huaweicloud_images
{
    private $app_key = '';
    private $app_secret = '';

    public function __construct($app_key, $app_secret)
    {
        $this->app_key = $app_key;
        $this->app_secret = $app_secret;
    }

    public function image_tagging_aksk($data = "", $url = "", $threshold = 5, $language = 'en', $limit = '10')
    {
        $result = image_tagging_aksk($this->app_key, $this->app_secret, $data, $url, $threshold, $language, $limit);
        $result = json_decode($result, true);
        return $result;
    }

}