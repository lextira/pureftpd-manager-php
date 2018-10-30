<?php
namespace Lextira\PureFTPdClient\Models;

use http\Exception\BadMethodCallException;

class Domain extends BaseModel {
    protected $path = '/domains';

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