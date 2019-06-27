<?php

class Form {

    private $subjects = array(
        'faq' => 'Добавление вопроса партнер ЛИГА',
        'review' => 'Добавление отзыва партнер ЛИГА',
        'callback' => 'Запрос на обратную связь партнер ЛИГА',
        'order' => 'Заказ документа партнер ЛИГА',
        'comment' => 'Комментарий партнер ЛИГА',
    );
    private $post = array();
    private $message = '';
    
    private $errorMessage = 'К сожалению при отправке вашего запроса произошла ошибка. Мы уже приступили к устранению причин неполадки.';
    private $callBackMessage = 'Спасибо за то что обратились к нам, ваш запрос поступил на обработку. Скоро мы свяжемся с вами.';
    private $faqMessage = 'Спасибо за ваш вопрос. Мы обязательно дадим вам ответ.';
    private $reviewMessage = 'Спасибо за ваш отзыв. Мы благодарны за вашу активность.';
    private $orderMessage = 'Спасибо за ваш заказ. Мы свяжемся с вами в ближайшее время для уточнения деталей.';
    private $commentMessage = 'Спасибо за ваш комментарий, нам важно ваше мнение.';

    public function __construct(array $post) {
        $this->post = $post;
    }

    public function process() {
        if (isset($this->post['callback'])) {
            $this->callBack();
        }
        if (isset($this->post['order'])) {
            $this->order();
        }
        if (isset($this->post['review'])) {
            $this->review();
        }
        if (isset($this->post['faq'])) {
            $this->faq();
        }
        if (isset($this->post['comment'])) {
            $this->comment();
        }
    }

    private function callBack() {
        $callBack = new FormAction();
        $callBack->__attributes = $this->post['callback'];
        
        if(preg_match('/[a-z0-9]+/i', $callBack->name, $matches)){
            return false;
        }
        
        $callBack->time = time();
        
        if ($callBack->save()) {
            $mail = new ModelEmail($callBack, $this->subjects['callback']);
            $mail->send();

            $this->message = $this->callBackMessage;
        } else {
            $this->message = $this->errorMessage;
        }
    }


    private function order() {
        
        $document = Theme::themeModel($this->post['order']['doc']);
        if(!$document){
            return;
        }
        
        $order = new FormAction();
        $order->__attributes = $this->post['order'];
        
        if(preg_match('/[a-z0-9]+/i', $order->name, $matches)){
            return false;
        }
        
        $order->comment .= 'Нзвание документа: '.$document->title.'<br>';
        $order->type = FormAction::ORDER;
        $order->time = time();
        
        
        foreach($this->post['order'] as $key=>$val){
            if(!in_array($key, $order->standart) and $key != 'doc'){
                $field = Field::modelWhere('name = ?', array($key));
                if($field){
                    $order->comment .= $field->title.': '.$val.'<br>';
                }
            }
        }
        
        if ($order->save()) {
            $mail = new ModelEmail($order, $this->subjects['order']);
            $mail->send();

            $this->message = $this->orderMessage;
        } else {
            $this->message = $this->errorMessage;
        }
    }
    
    private function review() {
        $review = new Review();
        $review->__attributes = $this->post['review'];
        
        if(isset($this->post['review']['doc'])){
            $document = Theme::themeModel($this->post['review']['doc']);
            if($document){
               $review->id_theme = $document->id;
            }
        }
        
        if(preg_match('/[a-z0-9]+/i', $review->name, $matches)){
            return false;
        }
        
        $review->cheked = Review::ON_REVIEW;
        $review->time = time();
        
        $review->ip = $_SERVER['REMOTE_ADDR'];
        
        if ($review->save()) {
            $mail = new ModelEmail($review, $this->subjects['review']);
            $mail->send();

            $this->message = $this->reviewMessage;
        } else {
            $this->message = $this->errorMessage;
        }
    }
    
    private function faq() {
        $faq = new Faq();
        $faq->__attributes = $this->post['faq'];
        
        if(preg_match('/[a-z0-9]+/i', $faq->question, $matches)){
            return false;
        }
        
        $faq->cheked = Faq::ON_REVIEW;
        $faq->time = time();
        
        $faq->ip = $_SERVER['REMOTE_ADDR'];
        
        if ($faq->save()) {
            $mail = new ModelEmail($faq, $this->subjects['faq']);
            $mail->send();

            $this->message = $this->faqMessage;
        } else {
            $this->message = $this->errorMessage;
        }
    }
    
    private function comment() {
        $comment = new Comment();
        $comment->__attributes = $this->post['comment'];
        $comment->cheked = Comment::ON_REVIEW;
        $comment->time = time();
        
        $comment->ip = $_SERVER['REMOTE_ADDR'];
 
        if ($comment->save()) {
            $mail = new ModelEmail($comment, $this->subjects['comment']);
            $mail->send();

            $this->message = $this->commentMessage;
        } else {
            $this->message = $this->errorMessage;
        }
    }

    public function getMessage() {
        return $this->message;
    }
}
