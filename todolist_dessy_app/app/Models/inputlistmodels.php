<?php

namespace App\Models;

use CodeIgniter\Model;

class InputListModels extends Model
{
	protected $table		= 'todolist';
	protected $primaryKey		= 'id_list';
	protected $useAutoIncrement	= true;
	protected $allowedFields	= ['Title'];
}