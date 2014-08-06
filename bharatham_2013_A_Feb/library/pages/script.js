$(document).ready(function(){
 
    $('#bttn1').live('click',function(){
        $.ajax({
            type: "POST",
            url: $('#feeds .url1').html(),
            dataType: "text",
            success: function(data){ 
                  $('#feeds').html(data);
				}
	    });
    });
	
	$('#bttn2').live('click',function(){ 
        $.ajax({
            type: "POST",
            url: $('#feeds .url2').html(),
            dataType: "text",
            success: function(data){
                  $('#feeds').html(data);
				}
	    });
    });
	
	$('#bttn3').live('click',function(){ 
        $.ajax({
            type: "POST",
            url: $('#reviews .url1').html(),
            dataType: "text",
            success: function(data){
                  $('#reviews').html(data);
				}
	    });
    });
	
	$('#bttn4').live('click',function(){ 
        $.ajax({
            type: "POST",
            url: $('#reviews .url2').html(),
            dataType: "text",
            success: function(data){
                  $('#reviews').html(data);
				}
	    });
    });
});