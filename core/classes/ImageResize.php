<?php

class ImageResize
{
    private $width = 0;
    private $height = 0;
    private $tWidth = 0;
    private $tHeight = 0;
    private $type = '';
    
    public function init($src, $width)
    {
        //функция getimagesize() возвращает информацию о файле.
        $size = getimagesize($src);
        //ширина изображения:
        $this->width= $size['0'];
        //высота изображения:
        $this->height= $size['1'];
        //mime тип файла:
        $this->type = $size['mime'];
        //отношение ширины к высоте, далее будет использовано для пропорционального ресайза изображения
        $ratio = $this->width/ $this->height;
        //ширина превью:
        $this->tWidth = $width;
        //высота превью:
        $this->tHeight = $this->tWidth / $ratio;
    }
    
    public function __construct($src, $width)
    {
        $this->init($src, $width);
        //передаем браузеру заголовок типа контента:
        header("Content-type: $this->type");
        
        //переключатель типов, возможные варианты изображений: jpg, png и gif:
        switch ($this->type)
        {
            case 'image/jpg':
            case 'image/jpeg':
                $src_img = imagecreatefromjpeg($src);
                $emptyIM = $this->imageSettings($src_img);
                $markedSRC = $this->watermark($src_img);
                $newIm = $this->resize($markedSRC, $emptyIM);
                imagejpeg($newIm);
                break;
            case 'image/png':
                $src_img = imagecreatefrompng($src);
                $emptyIM = $this->imageSettings($src_img);
                $markedSRC = $this->watermark($src_img);
                $newIm = $this->resize($markedSRC, $emptyIM);
                imagepng($newIm);
                break;
            default:
                echo "Формат изображения не поддерживается.";
        }
        imagedestroy($newIm);
        die();
    }

    private function imageSettings($src_img)
    {
        //Новое изображение нужного размера
        $im = imagecreatetruecolor($this->tWidth, $this->tHeight);
        
        //Получаем идинтификатор цвета подложки
        $black = imagecolorallocate($im, 0, 0, 0);
        //Делаем фон прозрачным
        imagecolortransparent($im, $black);

        imagealphablending($im, false);
        imagesavealpha($im, true);
        
        return $im;
    }
    
    private function watermark($src_img)
    {
         //Watermark
        $stamp = imagecreatefrompng(ROOT.'/'.Picture::water());
        
//        $marge_right = 0;
//        $marge_bottom = 0;
        
        $marge_right = 200;
        $marge_bottom = 10;
        $sx = imagesx($stamp);
        $sy = imagesy($stamp);
        $zx = imagesx($src_img);
        $zy = imagesy($src_img);
        
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 100, $zy - $sy - $marge_bottom, 0, 0, $sx, $sy);
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 100, $zy - $sy - $marge_bottom - 225, 0, 0, $sx, $sy);
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 100, $zy - $sy - $marge_bottom - 450, 0, 0, $sx, $sy);
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 100, $zy - $sy - $marge_bottom - 675, 0, 0, $sx, $sy);
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 100, $zy - $sy - $marge_bottom - 900, 0, 0, $sx, $sy);
		
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 800, $zy - $sy - $marge_bottom, 0, 0, $sx, $sy);
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 800, $zy - $sy - $marge_bottom - 225, 0, 0, $sx, $sy);
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 800, $zy - $sy - $marge_bottom - 450, 0, 0, $sx, $sy);
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 800, $zy - $sy - $marge_bottom - 675, 0, 0, $sx, $sy);
        imagecopy($src_img, $stamp, $zx - $sx - $marge_right - 800, $zy - $sy - $marge_bottom - 900, 0, 0, $sx, $sy);
        //Отключаем альфа спряжение
        imagealphablending($stamp, false);
        //Установка Альфа влага
        imagesavealpha($stamp, true);
        
        return $src_img;
    }
    
    private function resize($src_img, $newIm)
    {
        //Копируем изображение
        imagecopyresampled($newIm, $src_img, 0, 0, 0, 0, $this->tWidth, $this->tHeight, $this->width, $this->height);
        
        //Отключаем альфа спряжение
        imagealphablending($src_img, false);
        //Установка Альфа влага
        imagesavealpha($src_img, true);

        return $newIm;
    }
}
