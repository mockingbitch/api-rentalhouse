<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepositoryInterface;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * Model
     * @var Model $model
     */
    protected Model $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * Create query
     *
     * @return Builder
     */
    public function query(): Builder
    {
        return $this->model->newQuery();
    }

    /**
     * Get model
     *
     * @return mixed
     */
    abstract public function getModel();

    /**
     * Set model
     * @throws BindingResolutionException
     */
    public function setModel()
    {
        $this->model = app()->make(
            $this->getModel()
        );
    }

    /**
     * Get all
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Find by id
     *
     * @param $id
     * @return mixed
     */
    public function find($id): mixed
    {
        return $this->model->find($id);
    }

    /**
     * find first
     *
     * @param $conditions
     * @return object|null
     */
    public function whereFirst($conditions): object|null
    {
        return $this->model->newQuery()->where($conditions)->first();
    }

    /**
     * find all by where
     *
     * @param $conditions
     * @return Collection|array
     */
    public function where($conditions): Collection|array
    {
        return $this->model->newQuery()->where($conditions)->get();
    }

    /**
     * Create
     *
     * @param $attributes
     * @return mixed
     */
    public function create($attributes = []): mixed
    {
        return $this->model->create($attributes);
    }

    /**
     * Insert data
     *
     * @param $data
     * @return bool
     */
    public function insert($data): bool
    {
        return $this->model->newQuery()->insert($data);
    }

    /**
     * Insert get id
     *
     * @param array $attributes
     * @return int
     */
    public function insertGetId(array $attributes = []): int
    {
        return $this->model->newQuery()->insertGetId($attributes);
    }

    /**
     * Update
     *
     * @param $id
     * @param $attributes
     * @return false|mixed
     */
    public function update($id, $attributes = []): mixed
    {
        $result = $this->find($id);
        if ($result) {
            $result->update($attributes);
            return $result;
        }

        return false;
    }

    /**
     * Delete
     *
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $result = $this->find($id);
        if ($result) {
            $result->delete();

            return true;
        }

        return false;
    }

    /**
     * Find first with relationship
     *
     * @param array $conditions
     * @param array $relations
     * @return object|null
     */
    public function findOneWithRelation(array $conditions = [], array $relations = []): ?object
    {
        return $this->model->newQuery()
            ->with($relations)
            ->where($conditions)
            ->first();
    }
}
