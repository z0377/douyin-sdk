<?php
namespace Douyin\Oauth;

use Douyin\Base\Base;

class Oauth extends Base
{
    const ACCESS_TOKEN_URL = "https://open.douyin.com/oauth/access_token/";
    /**
     * 抖音获取授权码
     *
     * @param string $scope 应用授权作用域,多个授权作用域以英文逗号（,）分隔
     * @param string $redirect_uri 授权成功后的回调地址
     * @return string
     */
    public static function getConnectUrl($scope,$redirect_uri)
    {
        $url = "https://open.douyin.com/platform/oauth/connect/?client_key=".self::$config['key']."&response_type=code&scope=".$scope."&redirect_uri=".$redirect_uri;
        return $url;
    }

    /**
     * 获取access
     *
     * @param string $code 授权码
     * @return string
     */
    public static function getAccessToken($code)
    {
        $param = [
            'code' => $code,
            'client_secret' => self::$config['secret'],
            'grant_type' => 'authorization_code',
            'client_key' => self::$config['key']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST',self::ACCESS_TOKEN_URL,['form_params' => $param]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}