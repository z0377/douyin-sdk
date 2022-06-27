<?php
namespace Douyin\Comment;

use Douyin\Douyin;

class Comment extends Douyin
{
    const COMMENT_LIST = "item/comment/list/";
    const REPLY_LIST = "item/comment/reply/list/";
    const COMMENT_REPLY = "item/comment/reply/";

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 评论列表
     *
     * @param Array $param 
     * @return Array
     */
    public function getCommentList(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0,
            'item_id' => $param['item_id'],
            'sort_type' => $param['sort_type'] ?? 'time',
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::COMMENT_LIST,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 评论回复列表
     *
     * @return Array
     */
    public function getReplyList(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0,
            'item_id' => $param['item_id'],
            'comment_id' => $param['comment_id'],
            'sort_type' => $param['sort_type'] ?? 'time',
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::REPLY_LIST,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 回复视频评论
     *
     * @param Array $param
     * @return Array
     */
    public function commentReply(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'item_id' => $param['item_id'],
            'comment_id' => $param['comment_id'],
            'content' => $param['content']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST',$this->config['base_url'].self::COMMENT_REPLY.'?open_id='.$param['open_id'],['json' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}