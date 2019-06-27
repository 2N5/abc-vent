<div class="col-md-10">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Название</th>
                    <th>Адрес файла</th>
                    <th>Изображение</th>
                </tr>
            </thead>
            <tbody>
            <form action="/cp/picture/add" method="POST" enctype="multipart/form-data"> 
                <tr style="background-color: #3a4962;">
                    <td>
                        <input type="file" name="picture" required />
                    </td>
                    <td>
                        
                    </td>
                    <td>
                        <input type="submit" value="Загрузить изображение" />
                    </td>
                </tr> 
            </form>
            <?php foreach ($files as $file) { 
                if($file === '.' or $file === '..' or is_dir('../uploads/artimg/'.$file))
                {
                    continue;
                }
            ?>
                <tr>
                    <td>
                        <?=$file; ?>
                    </td>
                    <td>
                        <?='/uploads/artimg/'.$file; ?>
                    </td>
                    <td>
                        <img src="<?='/uploads/artimg/'.$file; ?>" style="width:150px;" >
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>