<?php
namespace Lextira\PureFTPdClient\Models;

class Health extends BaseModel {
    protected $path = '/health';
    protected $auth = false;

    public function check()
    {
        return $this->client->get($this->path . '/check', [
            'headers' => $this->getHeaders(),
        ]);
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