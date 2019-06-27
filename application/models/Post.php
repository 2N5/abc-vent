<?php
class Post extends ModelTable {
	static $table = 'post';
	public $safe = array('id', 'id_page', 'question', 'answer', 'img', 'go_url','meta_title','meta_keywords','meta_description','meta_head');
        
}