<?php
class Spravka extends Theme {
    
    static $table = 'spravka';
    public $safe = array('id', 'id_category', 'price', 'sub_title', 'title', 'url', 'h1', 'description',
                            'content', 'type', 'meta_title', 'meta_keywords', 'meta_description');

}