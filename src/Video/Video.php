<?php
namespace Douyin\Video;

use Douyin\Douyin;

class Video extends Douyin
{
    const VIDEO_LIST = "video/list/";
    const VIDEO_DATA = "video/data/";
    const POI_SEARCH_URL = "poi/search/keyword/";
    const VIDEO_SOURCE = "video/source/";
    const VIDEO_DELETE = "video/delete/";
    const ITEM_BASE_URL = "data/external/item/base/";
    const ITEM_LIKE_URL = "data/external/item/like/";
    const ITEM_COMMENT_URL = "data/external/item/comment/";
    const ITEM_PLAY_URL = "data/external/item/play/";
    const ITEM_PLAY_SHARE = "data/external/item/share/";

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 查询授权账号视频列表
     *
     * @param Array $param 
     * @return Array
     */
    public function getVideoList(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::VIDEO_LIST,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 查询授权账号视频列表
     *
     * @param Array $param 
     * @return Array
     */
    public function getVideoData(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'item_ids' => $param['item_ids'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST',$this->config['base_url'].self::POI_SEARCH_URL.'?open_id='.$param['open_id'],['json' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 查询视频携带的地点信息
     *
     * @param Array $param 
     * @return Array
     */
    public function getPoiBySearchKeyword(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'keyword' => $param['keyword'],
            'city' => $param['city'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::VIDEO_LIST,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 查询抖音视频来源
     *
     * @param Array $param 
     * @return Array
     */
    public function getVideoSource(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'item_ids' => $param['item_ids'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST',$this->config['base_url'].self::VIDEO_SOURCE.'?open_id='.$param['open_id'],['json' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 删除视频
     *
     * @param Array $param 
     * @return Array
     */
    public function deleteVideo(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'item_id' => $param['item_id'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST',$this->config['base_url'].self::VIDEO_DELETE.'?open_id='.$param['open_id'],['json' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取视频基础数据
     *
     * @param Array $param 
     * @return Array
     */
    public function getItemBase(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'item_id' => $param['item_id']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::ITEM_BASE_URL,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取视频点赞数据
     *
     * @return Array
     */
    public function getItemLike(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'item_id' => $param['item_id'],
            'date_type' => $param['date_type'] ?? 7
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::ITEM_LIKE_URL,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取视频评论数据
     *
     * @return Array
     */
    public function getItemComment(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'item_id' => $param['item_id'],
            'date_type' => $param['date_type'] ?? 7
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::ITEM_COMMENT_URL,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取视频播放数据
     *
     * @return Array
     */
    public function getItemPlay(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'item_id' => $param['item_id'],
            'date_type' => $param['date_type'] ?? 7
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::ITEM_PLAY_URL,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取视频分享数据
     *
     * @return Array
     */
    public function getItemShare(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'item_id' => $param['item_id'],
            'date_type' => $param['date_type'] ?? 7
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::ITEM_PLAY_SHARE,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}