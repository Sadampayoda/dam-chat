<?php

namespace App\Repository;

use App\Repository\Interface\BaseQueryInterface;


class BaseQueryRepository implements BaseQueryInterface{

    protected $model;

    public function setModel($model)
    {
        $this->model = new $model;
    }

    public function all($limit = 0)
    {
        $query = $this->model->all();
        return $limit == 0 ? $query : $query->limit($limit);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function where(array $where = [], array $with = [], array $whereRelation = [], $limit = 0)
    {
        $query = $this->model->select('*');
        foreach($where as $key => $value)
        {
            $query->when($value,function($query) use ($key,$value){
                $query->where($key,$value);
            });
        }
        if(!empty($with)){
            $query->with($with);
            if(!empty($whereRelation)){
                foreach ($whereRelation as $key => $value) {
                    $query->whereHas($key,function($query) use($key,$value){
                        if(count($value) == 1){
                            $query->where($key,$value);
                        }else{
                            $query->where($key,$value[0],$value[1]);
                        }
                    });
                }
            }
        }
        return $limit == 0 ? $query->get() : $query->limit($limit);
    }



    public function create(array $data)
    {
        $data = $this->model->create($data);
        return $data;
    }

    public function update(array $data, int $id)
    {
        $row = $this->model->findOrFail($id);

        if(!$row){
            return false;
        }

        $data = $row->update($data);
        return $data;
    }

    public function destroy(int $id)
    {
        $row = $this->model->findOrFail($id);

        if(!$row){
            return response()->json([
                'status' => 404,
                'data' => $id,
                'message' => 'Data Not Found'
            ]);
        }

        $data = $row->delete($id);
        return response()->json([
            'status' => 202,
            'data' => $data,
            'message' => 'Data Deleted Successfully'
        ]);
    }
}
