<?php
namespace Douyin\Star;

use Douyin\Douyin;

/**
 * 星图相关接口
 * access_token 传调用/oauth/client_token/生成的token，此token不需要用户授权
 */
class Star extends Douyin
{
    const HOT_LIST = "star/hot_list/";
    const AUTHOR_SCORE = "star/author_score/";
    const AUTHOR_SCORE_V2 = "star/author_score_v2/";

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 获取抖音星图达人热榜
     *
     * @param Array $param 
     * @return Array
     */
    public function getHostList(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'hot_list_type' => $param['hot_list_type']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::HOT_LIST,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取抖音星图达人指数
     *
     * @return Array
     */
    public function getAuthorScore(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::AUTHOR_SCORE,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取抖音星图达人指数数据V2
     *
     * @return Array
     */
    public function getAuthorScoreV2(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'unique_id' => $param['unique_id'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::AUTHOR_SCORE_V2,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}