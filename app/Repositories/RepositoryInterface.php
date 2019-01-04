<?php
namespace App\Repositories;
 
use App\Models\Post;

interface RepositoryInterface {
	
	public function paginate($items, $perPage = 4, $page = null, $options = []);

	public function paginateComments($items, $perPage = 4, $page = null, $options = []);

	public function getCommentBasePost(Post $post);

	public function getAllTag();

	public function getCategoryForHome();

	public function getAll();

}
