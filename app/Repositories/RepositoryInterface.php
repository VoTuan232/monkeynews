<?php
namespace App\Repositories;
 
interface RepositoryInterface {
	
	public function paginate($items, $perPage = 4, $page = null, $options = []);
	
}
