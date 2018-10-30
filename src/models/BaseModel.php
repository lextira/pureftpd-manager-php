<?php
namespace Lextira\PureFTPdClient\Models;

abstract class BaseModel {
    protected $client;
    protected $where = [];
    protected $order = [];
    protected $auth = true;
    protected $authToken = '';
    protected $path = '';

    public function __construct($client, $authToken='')
    {
        $this->client = $client;
        $this->authToken = $authToken;
    }

    public function getPage($page)
    {
        return $this->client->get($this->path, [
            'query' => ['page' => $page,],
            'headers' => $this->getHeaders(),
        ]);
    }

    public function get($id)
    {
        return $this->client->get($this->path . '/' . urlencode($id), [
            'headers' => $this->getHeaders(),
        ]);
    }

    public function delete($id)
    {
        return $this->client->delete($this->path . '/' . urlencode($id), [
            'headers' => $this->getHeaders(),
        ]);
    }

    public function create($data)
    {
        return $this->client->post($this->path, [
            'headers' => $this->getHeaders(),
            'json' => $data,
        ]);
    }

    public function update($id, $data)
    {
        return $this->client->put($this->path . '/' . urlencode($id), [
            'headers' => $this->getHeaders(),
            'json' => $data,
        ]);
    }

    protected function getHeaders()
    {
        $headers = [
            'User-Agent' => 'Lextira/PureFTPdClient/1.0',
            'Accept'     => 'application/json',
        ];

        if ($this->auth) {
            $headers['Authorization'] = 'Bearer ' . $this->authToken;
        }

        return $headers;
    }
}