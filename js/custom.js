$('#form-subscribe').on('submit', function(e){
	e.preventDefault();
	var formdata = $(this).serialize();
	var url = $(this).attr("action");
	$.ajax(url, {
        method: "POST",
        dataType: "JSON",
        data: formdata,
        beforeSend: function(){
        	$('#msg').html("<div class='alert alert-info'>Please wait...</div>");
        }
    }).done(function (result) {
        if(result.success){
            $('#msg').html("<div class='alert alert-success'>" + result.message + "</div>");
            $('#form-subscribe')[0].reset();
        }else {
            $('#msg').html("<div class='alert alert-danger'>" + result.message + "</div>");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        $('#msg').html("<div class='alert alert-danger'>An unexpected error occured</div>");
    });
});

$('#form-signup').on('submit', function(e){
    e.preventDefault();
    var formdata = $(this).serialize();
    var url = $(this).attr("action");
    $.ajax(url, {
        method: "POST",
        dataType: "JSON",
        data: formdata,
        beforeSend: function(){
            $('#msg').html("<div class='alert alert-info'>Please wait...</div>");
        }
    }).done(function (result) {
        if(result.success){
            $('#msg').html("<div class='alert alert-success'>" + result.message + "</div>");
            $('#form-signup')[0].reset();
        }else {
            $('#msg').html("<div class='alert alert-danger'>" + result.message + "</div>");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        $('#msg').html("<div class='alert alert-danger'>An unexpected error occured</div>");
    });
});

$('#form-login').on('submit', function(e){
    e.preventDefault();
    var formdata = $(this).serialize();
    var url = $(this).attr("action");
    $.ajax(url, {
        method: "POST",
        dataType: "JSON",
        data: formdata,
        beforeSend: function(){
            $('#msg').html("<div class='alert alert-info'>Please wait...</div>");
        }
    }).done(function (result) {
        if(result.success){
            window.location.href = 'welcome.php';
        }else {
            $('#msg').html("<div class='alert alert-danger'>" + result.message + "</div>");
        }
    }).fail(function (xhr, textStatus, errorThrown) {
        // if the login is successful, the server will redirect, which will cause a parsing error
        if (xhr.status === 200 && xhr.responseText.indexOf('welcome.php') !== -1) {
            window.location.href = 'welcome.php';
            return;
        }
        $('#msg').html("<div class='alert alert-danger'>An unexpected error occured</div>");
    });
});