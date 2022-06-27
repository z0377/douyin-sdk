<?php
namespace Douyin;

use Exception;

class Douyin
{
    public function __construct($config)
    {
        $this->config = $config ?? [];
    }

    public function driver($driver="douyin")
    {
        // if (is_null($this->config->get($driver))) {
        //     // throw new InvalidArgumentException("Driver [$driver]'s Config is not defined.");
        // }

        $this->drivers = $driver;
        switch ($this->drivers) {
            case 'douyin':
                $this->config['base_url'] = "https://open.douyin.com/";
                break;
            case 'toutiao':
                $this->config['base_url'] = "https://open.snssdk.com/";
                break;
            case 'xigua':
                $this->config['base_url'] = "https://open-api.ixigua.com/";
                break;
        }

        return $this;
    }

    public function gateway($gateway)
    {
        if (!isset($this->drivers)) {
            throw new Exception('Driver is not defined.');
        }
        $this->gateways = $this->createGateway($gateway);
        return $this->gateways;
    }

    protected function createGateway($gateway)
    {
        if (!file_exists(__DIR__.'/'.ucfirst($gateway).'/'.ucfirst($gateway).'.php')) {
            throw new Exception("Gateway [$gateway] is not supported.");
        }

        $gateway = __NAMESPACE__.'\\'.ucfirst($gateway).'\\'.ucfirst($gateway);

        return $this->build($gateway);
    }

    protected function build($gateway)
    {
        return new $gateway($this->config);
    }

    // public function __call($name, $arguments)
    // {
    //     var_dump($name);exit;
    // }
}