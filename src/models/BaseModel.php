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
        $response = $this->client->get($this->path, [
            'query' => ['page' => $page,],
            'headers' => $this->getHeaders(),
        ]);

        return $this->parseResponse($response);
    }

    public function get($id)
    {
        $response = $this->client->get($this->path . '/' . urlencode($id), [
            'headers' => $this->getHeaders(),
        ]);

        return $this->parseResponse($response);
    }

    public function delete($id)
    {
        $response = $this->client->delete($this->path . '/' . urlencode($id), [
            'headers' => $this->getHeaders(),
        ]);

        return $this->parseResponse($response);
    }

    public function create($data)
    {
        $response = $this->client->post($this->path, [
            'headers' => $this->getHeaders(),
            'json' => $data,
        ]);

        return $this->parseResponse($response);
    }

    public function update($id, $data)
    {
        $response = $this->client->put($this->path . '/' . urlencode($id), [
            'headers' => $this->getHeaders(),
            'json' => $data,
        ]);

        return $this->parseResponse($response);
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

    protected function parseResponse($response)
    {
        return json_decode($response->getBody());
    }
}