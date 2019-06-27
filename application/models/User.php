<?php
class User extends ModelTable {
	
    const UPLOAD_DIR = '/uploads/user/';
    
    public static $table = '';
    public $safe = array('id', 'id_role', 'auth_token', 'name');
    public $role = '';
    
    public function takeRole(){
        $this->role = Role::model($this->id_role)->title_ru;
    }
    
    public function takeImage() {
        $image = '';
        if(is_file($_SERVER['DOCUMENT_ROOT'] . self::UPLOAD_DIR . $this->id . '/' . $this->avatar) && $this->avatar != '') {
            $image = $this->avatar;
        }
        return $image;
    }
 
    public static function saveImage(User $user, $files) {
        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . User::UPLOAD_DIR . $user->id . '/';
        if (!file_exists($upload_dir)) {
            if (!mkdir($upload_dir, 0777, true)) {
                die('Не удалось создать: ' . $upload_dir);
            }
        }
        
      //  debug($file);
        die();
        if(!empty($file['name'])){
            $fileName = 'avatar';
            $type = explode('/', $file['type']);
            $fileName .= '.'.$type[1];
            move_uploaded_file($file['tmp_name'], $upload_dir . $fileName);
            $user->avatar = $fileName;

        }
        return $user->save();
    }
}
