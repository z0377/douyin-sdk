<?php
namespace Douyin\Oauth;

use Douyin\Douyin;

class Oauth extends Douyin
{
    const ACCESS_TOKEN_URL = "oauth/access_token/";

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 抖音获取授权码
     *
     * @param string $scope 应用授权作用域,多个授权作用域以英文逗号（,）分隔
     * @param string $redirect_uri 授权成功后的回调地址
     * @return string
     */
    public function getConnectUrl($param)
    {
        $url = $this->config['base_url']."platform/oauth/connect/?client_key=".$this->config['key']."&response_type=code&scope=".$param['scope']."&redirect_uri=".$param['redirect_uri'];
        return $url;
    }

    /**
     * 获取access
     *
     * @return string
     */
    public function getAccessToken($data)
    {
        $param = [
            'code' => $data['code'],
            'client_secret' => $this->config['secret'],
            'grant_type' => 'authorization_code',
            'client_key' => $this->config['key']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST',$this->config['base_url'].self::ACCESS_TOKEN_URL,['form_params' => $param]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}