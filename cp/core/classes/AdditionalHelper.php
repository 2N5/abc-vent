<?php

abstract class AdditionalHelper {

    const BUY = '1';
    const DELIVERY = '2';
    const HOW = '3';
    const PAYMENT = '4';
    const PHONE = '5';
    const PRICE = '6';
    const PRIVACY = '7';
    
    const GENERATE = 1;

    public static $russian = array(
        '1' => 'Купить',
        '3' => 'Как',
        '6' => 'Цена',
        '5' => 'Телефон',
        '2' => 'Доставка',
        '4' => 'Оплата',
        '7' => 'Приватность',
    );
    public static $type = array(
        '1' => 'Buy',
        '3' => 'How',
        '6' => 'Price',
        '5' => 'Phone',
        '2' => 'Delivery',
        '4' => 'Payment',
        '7' => 'Privacy',
    );

    public static function getModel($id) {
        return $id > 0 ? 'Additional' . self::$type[$id] : '';
    }

    public static function all($example=0) {
        $additionals = array();
        $maxC = 0;
        
        foreach (self::$type as $t) {
            $model = 'Additional' . $t;
            $additionals[$t] = $model::models();
        }

        foreach ($additionals as $add) {
            $maxC = count($add) > $maxC ? count($add) : $maxC;
        }
        
        $additionals['max'] = $maxC;
        
        if($example){
            return self::example($additionals);
        }
        
        return $additionals;
    }
    
    public static function example($adds) {
        return $adds[self::$type[self::BUY]][rand(0, count($adds[self::$type[self::BUY]]) - 1)]->title . ' [title] ' .
                $adds[self::$type[self::HOW]][rand(0, count($adds[self::$type[self::HOW]]) - 1)]->title . '. ' .
                $adds[self::$type[self::PRICE]][rand(0, count($adds[self::$type[self::PRICE]]) - 1)]->title . ' [price] ' .
                $adds[self::$type[self::PHONE]][rand(0, count($adds[self::$type[self::PHONE]]) - 1)]->title . ' [phone]. ' .
                $adds[self::$type[self::DELIVERY]][rand(0, count($adds[self::$type[self::DELIVERY]]) - 1)]->title . ', ' .
                $adds[self::$type[self::PAYMENT]][rand(0, count($adds[self::$type[self::PAYMENT]]) - 1)]->title . '. ' .
                $adds[self::$type[self::PRIVACY]][rand(0, count($adds[self::$type[self::PRIVACY]]) - 1)]->title . '.';
    }

}
