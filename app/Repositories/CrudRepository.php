<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class CrudRepository implements CrudInterface
{



	//To view all the data
	public function all($model)
	{
		return $model::get();
	}
	//Get an individual record
	public function get($model, $id)
	{
		return $model::find($id);
	}
	//Store the data
	public function store($model, array $data)
	{
		return $model::create($data);
	}
	//Update the data
	public function update($model, $id, array $data)
	{
		return $model::find($id)->update($data);
	}
	//Delete the data
	public function delete($model, $id)
	{
		return $model::destroy($id);
	}
}
?>
