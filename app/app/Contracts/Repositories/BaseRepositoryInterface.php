<?php

namespace App\Contracts\Repositories;

interface BaseRepositoryInterface
{
    /**
     * Create query
     *
     * @return mixed
     */
    public function query();

    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create($attributes = []);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, $attributes = []);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * Find first with relationship
     *
     * @param array $conditions
     * @param array $relations
     * @return object|null
     */
    public function findOneWithRelation(array $conditions = [], array $relations = []): ?object;
}
