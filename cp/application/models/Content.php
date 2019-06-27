<?php
class Content extends ModelTable {
	static $table = 'content';
	public $safe = array('id', 'type', 'id_category', 'url', 'title', 'meta_title', 'meta_keywords', 'meta_description', 'meta_head', 'content', 'mod_time');
}