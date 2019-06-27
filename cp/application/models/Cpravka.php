<?php
class Cpravka extends ModelTable {
	static $table = 'cpravka';
	public $safe = array('id', 'id_qa', 'id_category', 'price', 'price_title', 'page_name', 'url', 'img', 'page_content','page_type','meta_title','meta_keywords','meta_description','meta_head');

	public $fields = array();
        
        public static function getName($id=0){
            return self::model((int)$id)->page_name;
        }
}