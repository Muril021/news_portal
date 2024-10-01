<?php

namespace App\Repositories;

abstract class Repository
{
    protected $model, $table;

    public function __construct($model)
    {
        $this->model = $model;
        $this->table = $model->getTable();
    }

    public function fetchAll(array $filter)
    {
        $query = $this->query($filter);
        return $filter['paginated'] ? $query->paginate($filter['perPage']) : $query->get();
    }

    private function query(array $filter)
    {
        extract($filter);

        return $this->model->select($columns)
            ->when($sortBy,
                function ($query) use ($sortBy, $orderBy) {
                    if (strpos($sortBy, ',') === false) {
                        return $query->orderBy($sortBy, $orderBy);
                    }

                    $sortBy = explode(',', $sortBy);
                    foreach ($sortBy as $column) {
                        $query->orderBy($column, $orderBy);
                    }
        })
        ->when($offset && (isset($paginate) == false || $paginate == false),
            function ($query) use ($offset, $limit) {
                $query->skip($offset)->take($limit);
        })
        ->when(is_array($relations), function ($query) use ($relations) {
            $relations = !empty($relations) ? $relations : [];
            foreach ($relations as $relation) {
                $query->with($relation);
            }
        });
    }

    public function first(array $filters = [])
    {
        return $this->query($filters)->first();
    }

    public function findOrFail(string|int $id, array $filters = [])
    {
        $query = $this->query($filters);

        return $query->findOrFail($id);
    }

    public function find(string|int $id, array $filters = [])
    {
        $query = $this->query($filters);

        return $query->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data)
    {
        $data['id'] = $data['id'] ?? null;
        return $this->model->find($data['id'])
            ->update($data);
    }

    public function updateOrCreate(array $data)
    {
        return $this->model->updateOrCreate($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function delete(string|int $id)
    {
        return $this->model->findOrFail($id)
            ->delete();
    }

    public function forceDelete(string|int $id)
    {
        return $this->model->findOrFail($id)
            ->forceDelete();
    }

    public function restore(string|int $id)
    {
        return $this->model->findOrFail($id)
            ->restore();
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getTableName()
    {
        return $this->model->getTable();
    }
}
