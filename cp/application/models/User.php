<?php
class User extends ModelTable {

    public static $table = 'admin';
    public $safe = array('id', 'id_role', 'login', 'password', 'email', 'auth_token');
    
    function role(){
        return UserRole::model($this->_data->id_role);
    }
    
}
