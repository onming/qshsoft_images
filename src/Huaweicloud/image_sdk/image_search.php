<?php
require "signer.php";
require "ais.php";

/**
 * ak,sk 请求方式
 */
function image_search_request($_ak, $_sk, $uri, $method, $data = [])
{
    // 构建ak，sk对象
    $signer = new Signer();
    $signer->AppKey = $_ak;             // 构建ak
    $signer->AppSecret = $_sk;          // 构建sk

    $endPoint = "imagesearch.cn-north-4.myhuaweicloud.com";

    // 构建请求对象
    $req = new Request();
    $req->method = $method;
    $req->scheme = "https";
    $req->host = $endPoint;
    $req->uri = $uri;

    $headers = array(
        "Content-Type" => "application/json",
    );

    $req->headers = $headers;
    $req->body = json_encode($data);

    // 获取ak，sk方式的请求对象，执行请求
    $curl = $signer->Sign($req);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_TIMEOUT, 5);
    $response = curl_exec($curl);
    $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    if ($status == 0) {
        throw new Exception($curl);
    } else {
        // 验证服务调用返回的状态是否成功，如果为2xx, 为成功, 否则失败。
        if (status_success($status)) {
            return json_decode($response, true);
        } else {
            return json_decode($response, true);
        }
    }
    curl_close($curl);
}