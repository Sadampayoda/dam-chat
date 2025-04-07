<?php

namespace App\Repository\Interface;


Interface BaseQueryInterface {

    public function setModel($model);

    public function all($limit);

    public function find(int $id);

    public function where(array $where = [], array $with, array $whereRelation = [],$limit);

    public function create(array $data);

    public function update(array $data, int $id);

    public function destroy(int $id);
}
