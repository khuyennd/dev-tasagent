
$(function(){

    $('#username').focus(function () {
        if ($('#username').val() == " User Name") {
            $('#username').val("");
        }
        if ($('#username').val() == " 用户名") {
            $('#username').val("");
        }
        if ($('#username').val() == " 用戶名") {
            $('#username').val("");
        }
        if ($('#username').val() == " ログインＩＤ") {
            $('#username').val("");
        }
        $('#username').css("color", "#000");
    });
    $('#passwdf').focus(function() {
        if ($('#passwdf').val() == " Password") {
            $('#passwdf').val("");
        }
        $('#passwdf').hide();
        $('#passwd').show(); $('#passwd').focus();
        $('#passwd').val("");
        $('#passwd').css("color", "#000");
        });
	
	});

function showapp(id1,id2){
	var obj1 = $("#"+id1);
	var obj2 = $("#"+id2);
	if($(obj1).hasClass('fold')){
		$(obj2).removeClass('hidden');
		$(obj2).addClass('show');
		$(obj1).removeClass('fold');
		$(obj1).addClass('unfold');		
	}
	else if($(obj1).hasClass('unfold')){
		$(obj2).removeClass('show');
		$(obj2).addClass('hidden');
		$(obj1).removeClass('unfold');
		$(obj1).addClass('fold');		
	}		
}

/*mouse on over bigimg show*/







