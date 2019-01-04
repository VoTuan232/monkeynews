<?php 
namespace App\Repositories;

interface ResAltInterface
{
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
    public function show($id);
}