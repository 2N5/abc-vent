$(document).ready(function(){
    //Аякс запрос на удаление категории
    $('.element-delete').click(function(){
       var url = $(this).data('url');
       $.ajax({
            url: url ,
            type: 'POST',
            success: function(data){
                window.location = data;
            }
       }); 
    });  
    
    
    $('.sortbtn').click(function(){
        var cat = $(this).data('sort');
        if(cat != 'all'){
            var text = $(this).text();
            $('.sortitem').hide();
            $('.sortcat-' + cat).show();
            $('#categorySort span').text(text);
        } else {
            $('.sortitem').show();
            $('#categorySort span').text('Категория');
        }
    });
    function showSystemMessage(head, bodyText, buttonText){
	$("body").append(' <div class="modal fade" id="system-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="myModalLabel"></h4></div><div class="modal-body text-centered"><span></span></div><div class="modal-footer text-centered"><button class="btn btn-success" data-dismiss="modal"></button></div></div></div></div>');
	$('body').on('hidden.bs.modal', '#system-message', function (e) {
	  $(this).remove();
	});
    $('#system-message .modal-title').text(head);
    $('#system-message .modal-body span').text(bodyText);
    $('#system-message button').text(buttonText);
    $('#system-message').modal('show');
}
    
    
    
    function findArticles(query){
        if(query.length != 0){
            $.getJSON('/cp/subscriber/articleload?title=' + query, function(data){
                if(data.length != 0){
                    var result = '<ul>';
                    $(data).each(function(){
                        result += '<li style="position:relative"><a href="/cp/subscriber/sendmail/' + this.id + '" class="btn btn-primary btn-xs pull-right submit-lettering">Разослать</a><a href="/blog/article/' + this.url +'" target="_blank">' + this.title +'</a><br>' + this.content.replace(/<\/?[^>]+>/gi, '').substr(0, 200) + '</li>'
                    });
                    result += '</ul>';
                    $('.finder-results').html(result);
                } else {
                    $('.finder-results').html("<p>Поиск не дал результатов</p>");
                }
            });
        } else {
            $('.finder-results').html('');
        }
    }
    $('body').on('click', '.submit-lettering', function(){
        $.get($(this).attr('href'), function(){
            showSystemMessage('Успешно', 'Рассылка успешно создана', 'OK');
        });
        return false;
    });
    if($('#subscribeFinder').length > 0){
        findArticles($('#subscribeFinder').val().trim());
    }
    
    
    $('#subscribeFinder').keyup(function(){
        findArticles($(this).val().trim());
    });

    // Последняя крошка на своем месте
    var lastCrumb = $('.breadcrumb-container').children().last();
    var lastCrumbText = ($('.page-content').find('.col-md-10').last()[0].firstChild.data) ? $('.page-content').find('.col-md-10').last()[0].firstChild.data.trim() : '';

    if (lastCrumb.text() === '') {
    	lastCrumb.text(lastCrumbText);
    	$('.page-content').find('.col-md-10').last()[0].firstChild.data = '';
    }
});
