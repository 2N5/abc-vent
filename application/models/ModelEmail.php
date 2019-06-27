<?php

class ModelEmail {

    private $address = array('apmagedon2@gmail.com', 'akadem.sprav@gmail.com');
    
    private $subject = '';
    private $text = '';
    
    private $ignoreKeys = array('picture', 'type', 'id', 'id_picture', 'ip');
    
    private $model = null;

    public function __construct(ModelTable $model, $subject) {
        $this->model = $model;
        $this->subject = $subject;
        
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        $this->modelText();
    }
    
    public function send() {
        $mail = new PHPMailer();
        
        $mail->isMail();
        $mail->CharSet = 'utf-8';
        
        $mail->setFrom('webmaster@montaza.net');
        $mail->Subject = $this->subject;
        $mail->msgHTML($this->text);
        
        if(is_object($this->model->picture) and $this->file())
        {
            $mail->addAttachment($_SERVER['DOCUMENT_ROOT'].$this->model->picture->path);
        }
        
        foreach($this->address as $adres)
        {
            $mail->addAddress($adres, 'Письмо от партнер ЛИГА');
            $mail->send();
            $mail->clearAddresses();
            usleep(500);
        }
        
    }

    private function file() {
        $path = $this->model->picture->path;
        if ($path) {
            $fp = fopen($_SERVER['DOCUMENT_ROOT'].$path, "rb");
            if (!$fp) {
                return false;
            }
            return true;
        }
    }

    private function modelText() {
        $modelText = '';
        foreach($this->model->__attributes as $key=>$val)
        {
            if(in_array($key ,$this->ignoreKeys) or $val == ''){continue;}
            
            if(isset($this->model->translate[$key]))
            {
                $modelText .= $this->model->translate[$key].': ';
            }
            
            if ($key == 'time') {
                $modelText .= strftime('%d %B %Y | %X', $val);
//                $modelText .= strftime('%c', $val);
                $modelText .= "<br>";
                continue;
            }
            
            $modelText .= $val.'<br>';
        }
        $this->text = $modelText;
    }
}
