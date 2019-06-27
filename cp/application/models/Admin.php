<?php
class Admin extends ModelTable {
	
    const ACTIVE = 1;
    const UPLOAD_DIR = '/uploads/user/';
    
    public static $table = 'admin';
    public $safe = array('id', 'id_role', 'auth_token', 'fio', 'email', 'time', 'active');
    public $role = '';
    
    static function configure(){
        return self::modelWhere('configure = ?', array(self::ACTIVE));
    }
    
    function role(){
        return UserRole::model($this->_data->id_role);
    }
    
    public function takeRole(){
        $this->role = Role::model($this->id_role)->title_ru;
    }
}
