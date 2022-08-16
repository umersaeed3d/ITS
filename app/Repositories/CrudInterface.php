<?php

namespace App\Repositories;

interface CrudInterface
{
   public function all($model);

   public function get($model,$id);

   public function store($model, array $data);

   public function update($model, $id, array $data);

   public function delete($model, $id);
}
?>
