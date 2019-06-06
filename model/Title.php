<?php
namespace Model;
use Core\Model;

class Title extends Model{
	protected $table = 'titles';
	protected $fillable = ['title_description'];
	protected $primaryKey = 'title';
}

?>