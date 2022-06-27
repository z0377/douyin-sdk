<?php
namespace Douyin\Fans;

use Douyin\Douyin;

class Fans extends Douyin
{
    const FANS_DATA = "fans/data/";
    const FANS_SOURCE = "data/extern/fans/source/";
    const FANS_FAVOURITE = "data/extern/fans/favourite/";
    const FANS_COMMENT = "data/extern/fans/comment/";

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 获取用户粉丝数据
     *
     * @param Array $param 
     * @return Array
     */
    public function getFansData(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::FANS_DATA,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取用户粉丝来源
     *
     * @return Array
     */
    public function getFansSource(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::FANS_SOURCE,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取用户粉丝喜好
     *
     * @return Array
     */
    public function getFansFavourite(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::FANS_FAVOURITE,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

     /**
     * 获取用户粉丝热评
     *
     * @return Array
     */
    public function getFansComment(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::FANS_COMMENT,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}