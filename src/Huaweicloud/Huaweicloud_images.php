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

    public function image_tagging_aksk($data = "", $url = "")
    {
        // region目前支持华北-北京(cn-north-4)、亚太-香港(ap-southeast-1)
        init_region($region = 'cn-north-4');
        $result = image_tagging_aksk($this->app_key, $this->app_secret, $data, $url, 5, "zh", 2);
    }

}