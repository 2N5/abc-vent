<?php
class Certificate extends Theme {
    
    public static $table = 'certificate';
    public $safe = array('id', 'title', 'url', 'description', 'content', 'price', 'id_category',
                        'meta_title', 'meta_keywords', 'meta_description');
    
}
