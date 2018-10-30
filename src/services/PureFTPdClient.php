<?php
namespace Lextira\PureFTPdClient\Services;

use GuzzleHttp\Client;
use Lextira\PureFTPdClient\Models\Account;
use Lextira\PureFTPdClient\Models\Domain;
use Lextira\PureFTPdClient\Models\Health;
use Lextira\PureFTPdClient\Providers\PureFTPdServiceProvider;

class PureFTPdClient {
    protected $client;
    protected $authKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config(PureFTPdServiceProvider::CONFIG_PREFIX . '.host'),
        ]);
        $this->authKey = config(PureFTPdServiceProvider::CONFIG_PREFIX . '.auth_token');
    }

    public function accounts()
    {
        return new Account($this->client, $this->authKey);
    }

    public function domains()
    {
        return new Domain($this->client, $this->authKey);
    }

    public function health()
    {
        return new Health($this->client, $this->authKey);
    }
}