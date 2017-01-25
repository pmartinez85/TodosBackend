<?php


namespace App\Repositories\Contracts;


/**
 * Interface Repository
 * @package App\Repositories\Contracts
 */
interface Repository
{
    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findOrFail($id, $columns = ['*']);
    public function paginate($perPage = 15, $columns = array('*'));
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}