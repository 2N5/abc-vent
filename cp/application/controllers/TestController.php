<?php

class TestController extends Controller {

    static $rules = array(
        'index' => array(
            'users' => array('*'),
            'redirect' => '/cp/index'
        ),
        'meta' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
        ),
        'image' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
        ),
        'imagejpg' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
        ),
        'imagepng' => array(
            'users' => array('admin'),
            'redirect' => '/cp/authorize/login'
        ),
    );

    function actionIndex() {
        $this->render('index');
    }

    function actionMeta() {
        $buy = ['купить', 'оформить', 'заказать', 'приобрести'];
        $kak = ['недорого', 'быстро', 'без обучения', 'без очереди', 'на подлинном бланке', 'без предоплаты'];
        $cena = ['стоимость', 'лучшая цена', 'лучшее предложение', 'всего за', 'самая низкая цена'];
        $phone = ['Сделать заказ', 'Сделать заказ по номеру', 'Бесплатная консультация', 'Звоните, Ответим на ваши вопросы', 'Звоните, Ответим на вопросы', 'Обратная связь', 'Не думай, звони!',];

        $dostavka = ['доставка по Москве и регионам', 'доставка в любую точку России', 'доставка по всей России', 'быстрая доставка по России', 'быстрая доставка курьером', 'доставка в день заказа', 'доставка в тот же день',];
        $oplata_dostavki = ['оплата при получении', 'оплата после получения заказа', 'оплата после проверки документа', 'оплата наличными или картой', 'принимаем любые способы оплаты'];
        $konf = ['Персональные данные не передаются третьим лицам', 'абсолютная конфеденциальность', 'гарантируем полную конфеденциальность', 'Мы не храним ваши личные данные', 'Обеспечиваем безопасность ваших данных',];
        $skidki;
        $osobue_usloviya;


        $x = $buy[rand(0, count($buy) - 1)] . ' <strong>Удостоверение сварщика</strong> ' . $kak[rand(0, count($kak) - 1)] . '. ' . $cena[rand(0, count($cena) - 1)] . ' <strong>1900 руб.</strong> ' .
        $phone[rand(0, count($phone) - 1)] . '<strong> +7 960 645 32 43</strong>. ' .
        $dostavka[rand(0, count($dostavka) - 1)] . ', ' . $oplata_dostavki[rand(0, count($oplata_dostavki) - 1)] . '. ' . $konf[rand(0, count($konf) - 1)] . '.';

        echo $x;
    }

    function actionImage() {
        echo '<img src="/cp/test/imagejpg" />';
        echo '<img src="/cp/test/imagepng" />';
    }

    function actionImagejpg() {
        $this->mainTemplate = 'clear';

        header('Content-type: image/webp');

        $jpg = imagecreatefromjpeg('im1.jpg');

        if (is_resource($jpg)) {
            if (imagewebp($jpg, 'im11.webp')) {
                $webp = imagecreatefromwebp('im11.webp');

                //Получаем идинтификатор цвета подложки
                $black = imagecolorallocate($webp, 0, 0, 0);
                //Делаем фон прозрачным
                imagecolortransparent($webp, $black);

                imagealphablending($webp, true);
                imagesavealpha($webp, false);

                imagewebp($webp);
                imagedestroy($webp);
            }
        }

        die();
    }

    function actionImagepng() {
        $this->mainTemplate = 'clear';

        header('Content-type: image/webp');

        $png = imagecreatefrompng('im2.png');

        if (is_resource($png)) {
            if (imagewebp($png, 'im21.webp')) {
                $webp = imagecreatefromwebp('im21.webp');

                //Получаем идинтификатор цвета подложки
                $black = imagecolorallocate($webp, 0, 0, 0);
                //Делаем фон прозрачным
                imagecolortransparent($webp, $black);

                imagealphablending($webp, true);
                imagesavealpha($webp, false);

                imagewebp($webp);
                imagedestroy($webp);
            }
        }

        die();
    }

}
