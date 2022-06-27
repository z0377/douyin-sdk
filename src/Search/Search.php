<?php
namespace Douyin\Search;

use Douyin\Douyin;

class Search extends Douyin
{
    const VIDEO_SEARCH = "video/search/";
    const VIDEO_SEARCH_COMMENT_LIST = "video/search/comment/list/";
    const VIDEO_SEARCH_COMMENT_REPLY = "video/search/comment/reply/";
    const VIDEO_SEARCH_COMMENT_REPLY_LIST = "video/search/comment/reply/list/";

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 关键词视频搜索
     *
     * @param Array $param 
     * @return Array
     */
    public function videoSearch(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0,
            'keyword' => $param['keyword']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::VIDEO_SEARCH,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 关键词视频评论列表
     *
     * @return Array
     */
    public function getVideoSearchCommentList(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'sec_item_id' => $param['sec_item_id'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::VIDEO_SEARCH_COMMENT_LIST,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 关键词视频评论回复
     *
     * @param Array $param
     * @return Array
     */
    public function videoSearchCommentReply(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'sec_item_id' => $param['sec_item_id'],
            'comment_id' => $param['comment_id'],
            'content' => $param['content']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST',$this->config['base_url'].self::VIDEO_SEARCH_COMMENT_REPLY.'?open_id='.$param['open_id'],['json' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 关键词视频评论回复列表
     *
     * @param array $param
     * @return array
     */
    public function videoSearchCommentReplyList(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'sec_item_id' => $param['sec_item_id'],
            'comment_id' => $param['comment_id'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::VIDEO_SEARCH_COMMENT_REPLY_LIST,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}