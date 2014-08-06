$(document).ready( function(){

	var $houses = new Array("#hmughals","#hvykings","#haryans","#hspartans","#hrajputs"); 
    var $newhouses = new Array("m","v","a","s","r");	 
    var $i=0,$m;
	var $temphotos,$tempwinners,$tempoll,$tempbid;;
	
	// Dynamically updates the scores of each houses every 5 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_scores.php",
											dataType: "text",
											success: function(data){
																		var $pts = data.split(';');
																		for($i=0;$i<5;$i++)
																			$($houses[$i] + ' #dspmme').html($pts[$i]);			
																	}
										});
							}, 5000);
	
	// Dynamically post new questions for feed every 10 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_feed_qstn.php",
											dataType: "text",
											success: function(data){
																		$('#newyear1').html(data);
																	}
										});
							}, 10000);
	
    // Dynamically post mobile feeds for questions each 5 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_feeds.php",
											dataType: "text",
											success: function(data){
																		var $txt = data.split("*###*");
																		for($i=1;$i<4;$i++)
																			$('#box1 #b' + $i).html($txt[$i-1]);
																	}
										});
							}, 5000);
	
    // Dynamically post new events for feed every 10 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_review_qstn.php",
											dataType: "text",
											success: function(data){
																		$('#newyear2').html('Live Review - '+data);			
																	}
										});
							}, 10000);
	
	
	// Dynamically post mobile reviews for events each 5 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_reviews.php",
											dataType: "text",
											success: function(data){
																		var $txt = data.split("*###*");
																		for($i=6;$i<10;$i++)
																			$('#box1 #b' + $i).html($txt[$i-6]);
																	}
										});
							}, 5000);
	
	
	// Dynamically choose the center portion - Images, Winners, Polling, or Bidding
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_center.php",
											dataType: "text",
											success: function(data){
																		if(data == "Photos")
																		{
																			$('#pge6').fadeOut(1500);
																			$('#pge4').animate({'width': '400px'},1000);
																			$('#content3').fadeIn(1000);
																										
																			$('#pge2').fadeOut(1);
																			$('#pge3').fadeOut(1);
																			$('#pge4').fadeOut(1);
																			$('#pge1').fadeIn(1000);
																			$('#pge2').removeClass("Winners");
																			$('#pge3').removeClass("Polling");
																			$('#pge4').removeClass("Bidding");
																			
																			if(!$('#pge1').hasClass("Photos"))
																			{
																				$.ajax({
																							type: "POST",
																							url: "./library/js_images.php",
																							dataType: "text",
																							success: function(data){
																														$temphotos = data;
																														$('#slideshowHolder div').empty();
																														for($i=0;$i<data;$i++)
																															$('#slideshowHolder').append('<img src="./images/' + (data-$i) + '.jpeg" width="400px" height="120px;" />');
																														$('#slideshowHolder').jqFancyTransitions({ effect: 'wave',strips: 20,delay: 3000,stripDelay: 25,position: 'alternate' });	
																													}
																						});
																			}			
																			$('#pge1').addClass("Photos");
																		}
																		else if(data == "Winners")
																		{
																			$('#pge6').fadeOut(1500);
																			$('#pge4').animate({'width': '400px'},1000);
																			$('#content3').fadeIn(1000);
																			$('#pge1').fadeOut(1);
																			$('#pge3').fadeOut(1);
																			$('#pge4').fadeOut(1);
																			$('#pge2').fadeIn(1000);
																			$('#pge1').removeClass("Photos");
																			$('#pge3').removeClass("Polling");
																			$('#pge4').removeClass("Bidding");
																			
																			if(!$('#pge2').hasClass("Winners"))
																			{
																				$.ajax({
																							type: "POST",
																							url: "./library/js_winners.php",
																							dataType: "text",
																							success: function(data){
																														$tempwinners = data;
																														var $pts = data.split('*#*');
																														var $hse = new Array("#first","#second","#third");
																														for($i=0;$i<3;$i++)
																														{
																															var $clr = $pts[$i].split(';');
																															switch($clr[1])
																															{
																																case "Mughals"  :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(254,150,1) 3%, #2F2727, rgb(254,150,1) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(254,150,1)'});break;
																																case "Vyking"   :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(20,70,245) 3%, #2F2727, rgb(20,70,245) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(20,70,245)'});break;
																																case "Aryans"   :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(254,25,4) 3%, #2F2727, rgb(254,25,4) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(254,25,4)'});break;
																																case "Spartans" :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(222,3,57) 3%, #2F2727, rgb(222,3,57) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(222,3,57)'});break;
																																case "Rajputs"  :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(255,235,1) 3%, #2F2727, rgb(255,235,1) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(255,235,1)'});break;
																															}
																															$($hse[$i] + ' #display').html($pts[$i]);
																														}
																													}
																						});
																			}			
																			$('#pge2').addClass("Winners");
																		}
																		else if(data == "Bid")
																		{
																			$('#pge6').fadeOut(1500);
																			$('#pge4').animate({'width': '400px'},1000);
																			$('#content3').fadeIn(1000);
																			$('#pge2').fadeOut(1);
																			$('#pge3').fadeOut(1);
																			$('#pge1').fadeOut(1);
																			$('#pge4').fadeIn(1000);
																			$('#pge1').removeClass("Photos");
																			$('#pge2').removeClass("Winners");
																			$('#pge3').removeClass("Polling");
																			$('#content3').fadeOut(1000);
																			$('#pge4').animate({'width': '800px'},1000);
																			$('#pge6').delay(2000).fadeIn(1500);
																			if(!$('#pge4').hasClass("Bidding"))
																			{
																				$.ajax({
																							type: "POST",
																							url: "./library/js_bids.php",
																							dataType: "text",
																							success: function(data){
																														$tempbid = data;
																														var $pts = data.split(';');
																														$('#winner').html('Bid 4  ' + $pts[0]);
																														for($i=0;$i<20;$i++)
																															$('#w' + $i).html($pts[$i+1]);
																													}		
																						});
																			}
																			$('#pge4').addClass("Bidding");
																		}
																		else if(data == "Poll")
																		{
																			$('#pge6').fadeOut(1500);
																			$('#pge4').animate({'width': '400px'},1000);
																			$('#content3').fadeIn(1000);
																			$('#pge2').fadeOut(1);
																			$('#pge1').fadeOut(1);
																			$('#pge4').fadeOut(1);
																			$('#pge3').fadeIn(1000);
																			$('#pge1').removeClass("Photos");
																			$('#pge2').removeClass("Winners");
																			$('#pge4').removeClass("Bidding");
																			
																			if(!$('#pge3').hasClass("Polling"))
																			{
																				$.ajax({
																						type: "POST",
																						url: "./library/js_poll.php",
																						dataType: "text",
																						success: function(data){
																													$tempoll = data;
																													var $pts = data.split(';');
																													$('#polling').html('POLLING - <i>"' + $pts[0] + '"</i>');
																													for($i=1;$i<6;$i++)
																													{
																														$('#presult' + $i).fadeIn(1).animate({'width' : $pts[$i]+'%'},1500);
																														$('#count' + $i).html($pts[$i] + '%');
																													}	
																												}
																						});
																			}		
																			$('#pge3').addClass("Polling");
																		}			   
																	}
										});
							},1000);
	
	// Dynamically add new images to the center slider every 45 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_images.php",
											dataType: "text",
											success: function(data){
																		if($temphotos != data)
																		{
																			$('#slideshowHolder div').empty();
																			for($i=0;$i<data;$i++)
																				$('#slideshowHolder').append('<img src=".Bharatham/images/' + (data-$i) + '.jpeg" />');
																			$('#slideshowHolder').jqFancyTransitions({ effect: 'wave',strips: 20,delay: 3000,stripDelay: 25,position: 'alternate' });	
																		}
																	}	
										});
							}, 45000);
	
	// Dynamically update the promo text each 5 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_center_msg.php",
											dataType: "text",
											success: function(data){
																		$('#promo').html(data);		
																	}
										});
							}, 5000);
	
	// Dynamically display the winners list every 10 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_winners.php",
											dataType: "text",
											success: function(data){
																		if($tempwinners != data)
																		{
																			var $pts = data.split('*#*');
																			var $hse = new Array("#first","#second","#third");
																			for($i=0;$i<3;$i++)
																			{
																				var $clr = $pts[$i].split(';');
																				switch($clr[1])
																				{
																					case "Mughals"  :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(254,150,1) 3%, #2F2727, rgb(254,150,1) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(254,150,1)'});break;
																					case "Vyking"   :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(20,70,245) 3%, #2F2727, rgb(20,70,245) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(20,70,245)'});break;
																					case "Aryans"   :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(254,25,4) 3%, #2F2727, rgb(254,25,4) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(254,25,4)'});break;
																					case "Spartans" :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(222,3,57) 3%, #2F2727, rgb(222,3,57) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(222,3,57)'});break;
																					case "Rajputs"  :	$($hse[$i]).css({'background':'-moz-linear-gradient(left, #2F2727, rgb(255,235,1) 3%, #2F2727, rgb(255,235,1) 97%,#2F2727)','box-shadow':'0 0 10px 2px rgb(255,235,1)'});break;
																				}
																			$($hse[$i] + ' #display').html($clr[0]);
																			}
																		}	
																	}
										});
							}, 10000);
	
	// Dynamically display the polling list every 10 seconds if new data comes in
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_poll.php",
											dataType: "text",
											success: function(data){	if($tempoll != data)
																		{
																			var $pts = data.split(';');
																			$('#polling').html('POLLING - <i>"' + $pts[0] + '"</i>');
																			for($i=1;$i<6;$i++)
																			{
																				$('#presult' + $i).fadeIn(1).animate({'width' : $pts[$i]+'%'},1500);
																				$('#count' + $i).html($pts[$i] + '%');
																			}
																		}		
																	}
										});
							}, 10000);
							
	// Dynamically display the bidding list every 10 seconds if new data comes in
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_bids.php",
											dataType: "text",
											success: function(data){	if($tempbid != data)
																		{
																			var $pts = data.split(';');
																			$('#winners').html('Bid 4 ' + $pts[0]);
																			for($i=1;$i<10;$i++)
																				$('#w' + $i).html($pts[$i+1]);
																		}		
																	}
										});
							}, 10000);
	
	// Dynamically display the message count of each houses every 5 seconds
	setInterval(function() {
								$.ajax({
											type: "POST",
											url: "./library/js_cheers.php",
											dataType: "text",
											success: function(data){
																		var $msgs = data.split(';');
																		for($i=0;$i<5;$i++)
																		{
																			var $newmsgs = $msgs[$i].split('');
																			for($j=1;$j<5;$j++)
																				$('#f' + $newhouses[$i] + $j).html($newmsgs[$j-1]);
																		}
																	}	 
										});
							}, 2000);
});