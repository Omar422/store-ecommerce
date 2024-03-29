<?php

namespace App\Repository;

use App\Http\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{

    protected $model;

    public function __construct(Model $model) {

        $this->model = $model;

    }

    public function all() {

        return $this->model->all();

    }

    public function create(array $data) {

        return $this->model->create();

    }

    public function update(array $data, $id) {

        $record = $this->find($id);
        return $this->model->update($data);

    }

    public function delete($id) {

        return $this->model->destroy($id);

    }

    public function show($id) {

        return $this->model->findOrFail($id);

    }

    public function getModel($model) {

        return $this->model;

    }
    public function setModel($model) {

        $this->model = $model;
        return $this;

    }

    // database relations
    public function with($relations) {

        return $this->model->with($relations);

    }


}
