<?php

namespace Qshsoft\images;

require dirname(__FILE__)."/Huaweicloud/image_sdk/image_search.php";
require dirname(__FILE__)."/Huaweicloud/image_sdk/utils.php";
class Huaweicloud_imagesearch
{
    private $app_key = '';
    private $app_secret = '';
    private $project_id = '';

    public function __construct($config)
    {
        $this->app_key = $config['app_key'];
        $this->app_secret = $config['app_secret'];
        $this->project_id = $config['project_id'];
    }

    /**
     * 查询实例信息
     */
    public function info($instance_name)
    {
        $uri = "/v1/{$this->project_id}/service/{$instance_name}";
        $result = image_search_request($this->app_key, $this->app_secret, $uri, 'GET');
        return $result;
    }

    /**
     * 添加图片
     */
    public function add($instance_name, $file, $path, $tags)
    {
        $data = array(
            "file" => $file,         // 图片文件Base64编码字符串，仅支持JPEG/JPG/PNG/BMP格式，图片最小边不小于100px，最大边不超过2048px。
            "path" => $path,         // 图片的URL路径
            "tags" => $tags,         // 图片自定义标签
        );
        $uri = "/v1/{$this->project_id}/{$instance_name}/image";
        $result = image_search_request($this->app_key, $this->app_secret, $uri, 'POST', $data);
        return !empty($result['result'])?true:false;
    }

    /**
     * 搜索图片
     */
    public function search($instance_name, $file, $limit = 100, $offset = 0)
    {
        $data = array(
            "file" => $file,         // 图片文件Base64编码字符串，仅支持JPEG/JPG/PNG/BMP格式，图片最小边不小于100px，最大边不超过2048px。
            'limit' => $limit,       // 返回数量
            'offset' => $offset,     // 偏移量
        );
        $uri = "/v1/".$this->project_id."/{$instance_name}/image/search";
        $result = image_search_request($this->app_key, $this->app_secret, $uri, 'POST', $data);
        return $result;
    }

    /**
     * 修改图片信息
     */
    public function update($instance_name, $path, $tags)
    {
        $data = array(
            "path" => $path,         // 图片的URL路径
            "tags" => $tags,         // 图片自定义标签
        );
        $uri = "/v1/".$this->project_id."/{$instance_name}/image";
        $result = image_search_request($this->app_key, $this->app_secret, $uri, 'PUT', $data);
        return $result;
    }

    /**
     * 删除图片
     */
    public function delete($instance_name, $path)
    {
        $data = array(
            "path" => $path,         // 图片的URL路径
        );
        $uri = "/v1/".$this->project_id."/{$instance_name}/image";
        $result = image_search_request($this->app_key, $this->app_secret, $uri, 'DELETE', $data);
        return !empty($result['result'])?true:false;
    }

    /**
     * 查询图片
     */
    public function find($instance_name, $path)
    {
        $data = array(
            "path" => $path,         // 图片的URL路径
        );
        $uri = "/v1/".$this->project_id."/{$instance_name}/image/check";
        $result = image_search_request($this->app_key, $this->app_secret, $uri, 'POST', $data);
        return $result;
    }

}