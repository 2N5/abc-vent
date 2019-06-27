<div class="col-md-10">
    <div class="row">
        <a href="<?= $this->printControllerUrl(); ?>" class="btn btn-primary">К списку страниц</a>     
        <h2>Заполните все поля формы</h2><br>
        <form method="POST">
            meta_title: <input type="text" name="form[meta_title]" value="<?= $this->existSingleObject->meta_title; ?>" />
            meta_keywords: <input type="text" name="form[meta_keywords]" value="<?= $this->existSingleObject->meta_keywords; ?>" />
            meta_description: <input type="text" name="form[meta_description]" value="<?= $this->existSingleObject->meta_description; ?>" />
            
            H1: <input type="text" name="form[h1]" value="<?= $this->existSingleObject->h1; ?>" />
            <?php if($this->existSingleObject->url !== Contr::modelWhere('control = ?', array(Contr::MAP))->url){ ?>
            Название: <input type="text" name="form[title]" value="<?= $this->existSingleObject->title; ?>" />
            Url: <input type="text" name="form[url]" value="<?= $this->existSingleObject->url; ?>" />
            Контент : <textarea id="editor" name="form[content]"><?= $this->existSingleObject->content; ?></textarea>
            СЕО текст : <textarea id="editor1" name="form[seo_text]"><?= $this->existSingleObject->seo_text; ?></textarea>
            <?php } ?>
            <input type="submit" value="Сохранить изменения" />
        </form>
    </div>
</div>