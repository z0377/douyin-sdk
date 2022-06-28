<?php
namespace Douyin\Hot;

use Douyin\Douyin;

/**
 * 热点相关接口
 * access_token 传调用/oauth/client_token/生成的token，此token不需要用户授权
 */
class Hot extends Douyin
{
    const HOT_SENTENCES = "hotsearch/sentences/";
    const HOT_TRANDING_SENTENCES = "hotsearch/trending/sentences/";
    const HOT_VIDEOS = "hotsearch/videos/";

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 获取实时热点词
     *
     * @param Array $param 
     * @return Array
     */
    public function getHotSentences(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::HOT_SENTENCES,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取上升词
     *
     * @return Array
     */
    public function getHotTrandingSentences(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'cursor' => $param['cursor'] ?? 0,
            'count' => $param['count'] ?? 10
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::HOT_TRANDING_SENTENCES,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取热点词聚合的视频
     *
     * @return Array
     */
    public function getHotVideos(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'hot_sentence' => $param['hot_sentence']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::HOT_VIDEOS,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}