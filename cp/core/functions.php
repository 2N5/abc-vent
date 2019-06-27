<?php
function debug($data, $stop = false) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($stop) {
        exit();
    }
}

//генерация токена для авторизации
function generateToken() {
    return md5(uniqid(rand(), true));
}
//Функция установки куки юзера
function loginUser($token, $path = '/') {
    setcookie('auth_token', $token, time() + app::gi()->config->cookietime, $path);
}
//Функция удаления куки юзера
function logoutUser($path = '/') {
    setcookie('auth_token', '', time() - 1, $path);
}

function updateSiteMap()
{
    file_put_contents("../sitemap.xml", SiteMap::generateXML());
}

function echoIMG($picture)
{
    if($picture instanceof Picture or $picture instanceof CityPicture)
    {
        $file = $_SERVER['DOCUMENT_ROOT'].$picture->path;
        if(is_file($file))
        {
            return $picture->path;
        }
    }
    
    return noImgPath();
}
    
function noImgPath()
{
    return Picture::UPLOAD_DIR.Picture::NO_IMG;
}
    
function translit($string) {
    $alphabet = array(
        "А" => "A", "а" => "a",
        "Б" => "B", "б" => "b",
        "В" => "V", "в" => "v",
        "Г" => "G", "г" => "g",
        "Д" => "D", "д" => "d",
        "Е" => "Ye", "е" => "e",
        "Ё" => "Ye", "ё" => "e",
        "Ж" => "Zh", "ж" => "zh",
        "З" => "Z", "з" => "z",
        "И" => "I", "и" => "i",
        "Й" => "I", "й" => "i",
        "К" => "K", "к" => "k",
        "Л" => "L", "л" => "l",
        "М" => "M", "м" => "m",
        "Н" => "N", "н" => "n",
        "О" => "O", "о" => "o",
        "П" => "P", "п" => "p",
        "Р" => "R", "р" => "r",
        "С" => "S", "с" => "s",
        "Т" => "T", "т" => "t",
        "У" => "U", "у" => "u",
        "Ф" => "F", "ф" => "f",
        "Х" => "Kh", "х" => "kh",
        "Ц" => "Ts", "ц" => "ts",
        "Ч" => "Ch", "ч" => "ch",
        "Ш" => "Sh", "ш" => "sh",
        "Щ" => "Shch", "щ" => "shch",
        "Ы" => "Y", "ы" => "y",
        "Э" => "E", "э" => "e",
        "Ю" => "Yu", "ю" => "yu",
        "Я" => "Ya", "я" => "ya",
        "ъ" => "", "ь" => "", 
        "Ъ" => "", "Ь" => "", 
        " "=>"-", ","=>"",  "/"=>"",
        "_"=>"-", "|"=>"",
        "!"=>"", "@"=>"", "#"=>"",
        "$"=>"", "%"=>"", "^"=>"",
        "&"=>"", "*"=>"", "("=>"",
        "№"=>"", ";"=>"", ":"=>"",
        ")"=>"", "+"=>"", "?"=>"",
        "="=>"", '"'=>"", "<"=>"", 
        ">"=>"", "'"=>"", "."=>""
    );
	
    $stringInArray = array();
    $string = strtr($string, $alphabet);
    $stringInArray = explode('-', $string);
    $string = '';
	
    foreach($stringInArray as $part){
        if($part != ''){
            $string .= $part.'-';
        }
    }
    
    $string = substr($string, 0, strlen($string)-1);
	
    return strtolower($string);
}