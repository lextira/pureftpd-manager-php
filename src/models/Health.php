<?php
namespace Lextira\PureFTPdClient\Models;

class Health extends BaseModel {
    protected $path = '/health';
    protected $auth = false;

    public function check()
    {
        $response = $this->client->get($this->path . '/check', [
            'headers' => $this->getHeaders(),
        ]);

        return $this->parseResponse($response);
    }

    public function getPage($page)
    {
        throw new BadMethodCallException();
    }

    public function get($id)
    {
        throw new BadMethodCallException();
    }

    public function delete($id)
    {
        throw new BadMethodCallException();
    }

    public function create($data)
    {
        throw new BadMethodCallException();
    }

    public function update($id, $data)
    {
        throw new BadMethodCallException();
    }
}