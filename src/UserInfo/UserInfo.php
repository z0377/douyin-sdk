<?php
namespace Douyin\UserInfo;

use Douyin\Douyin;

class UserInfo extends Douyin
{
    const USERINFO_URL = "oauth/userinfo/";
    const FANS_LIST_URL = "fans/list/";
    const FOLLOWING_LIST_URL = "following/list/";
    const FANS_CHECK_URL = "fans/check/";
    const USER_ITEM = "data/external/user/item/";
    const USER_FANS = "data/external/user/fans/";
    const USER_LIKE = "data/external/user/like/";
    const USER_COMMENT = "data/external/user/comment/";
    const USER_SHARE = "data/external/user/share/";
    const USER_PROFILE = "data/external/user/profile/";

    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * 获取用户公开信息
     *
     * @param Array $param 
     * @return Array
     */
    public function getUserinfo(array $param)
    {
        $param = [
            'access_token' => $param['access_token'],
            'open_id' => $param['open_id'],
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('POST',$this->config['base_url'].self::USERINFO_URL,['json' => $param]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取粉丝列表
     *
     * @return Array
     */
    public function getFansnList(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::FANS_LIST_URL,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取关注列表
     *
     * @param Array $param
     * @return Array
     */
    public function getFollowingList(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'count' => $param['count'] ?? 10,
            'cursor' => $param['cursor'] ?? 0
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::FOLLOWING_LIST_URL,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 粉丝判断
     *
     * @param array $param
     * @return array
     */
    public function checkFans(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'follower_open_id' => $param['follower_open_id']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::FANS_CHECK_URL,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取用户视频情况
     *
     * @param array $param
     * @return array
     */
    public function getUserItem(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'date_type' => $param['date_type']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::USER_ITEM,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取用户粉丝数
     *
     * @param array $param
     * @return array
     */
    public function getUserFans(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'date_type' => $param['date_type']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::USER_FANS,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取用户点赞数
     *
     * @param array $param
     * @return array
     */
    public function getUserLike(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'date_type' => $param['date_type']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::USER_LIKE,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取用户评论数
     *
     * @param array $param
     * @return array
     */
    public function getUserComment(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'date_type' => $param['date_type']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::USER_COMMENT,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取用户分享数
     *
     * @param array $param
     * @return array
     */
    public function getUserShare(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'date_type' => $param['date_type']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::USER_SHARE,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }

    /**
     * 获取用户主页访问数
     *
     * @param array $param
     * @return array
     */
    public function getUserProfile(array $param)
    {
        $header = ['access-token' => $param['access_token']];
        $param = [
            'open_id' => $param['open_id'],
            'date_type' => $param['date_type']
        ];
        $client = new \GuzzleHttp\Client();
        $result = $client->request('GET',$this->config['base_url'].self::USER_PROFILE,['query' => $param,'headers' => $header]);
        $res = $result->getBody()->getContents();
        return json_decode($res,true);
    }
}