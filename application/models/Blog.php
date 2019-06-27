<?php 
class Blog extends ModelTable
{
    static $table = 'article';
    public $safe = array('id', 'url', 'title', 'content', 'time', 'picture_id',
                        'meta_title', 'meta_keywords', 'meta_description', 'description');
}