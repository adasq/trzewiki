$(function() {
	
	var base_url="http://localhost/testy/";
	

	//select text on search input
	$("#search-input").on("click",function(e){
		$(this).select();		
	});

	
	var GLOBALS_VARS= {
		curr_lid:null,
		curr_cid:null,
		tags: null
	};


	$("#catalogs-popup").on("click","a.targetCatalog",function(e){
	
		e.preventDefault();
		var cid= ($(this).attr("id")).substr(4);
		
		//alert(cid+' '+GLOBALS_VARS.curr_lid);
		
		GLOBALS_VARS.tags=$("#taginput").val();
		
		$.ajax({
		  type: "POST",
		  url: base_url+"linkToCatalog",
		  dataType: "json",
		  data: { cid: cid, lid: GLOBALS_VARS.curr_lid, tags: GLOBALS_VARS.tags }
		}).done(function( status ) {
			closePopup();
		  console.log(status);
		  if(status.error){
		  alert('Wystąpił błąd: '+status.info);
		  }else{
		//  alert('Wszystko OK: '+status.info);
		  }	  	  
		});
	});

	$("#catalogs-popup").on("click","a.catalogs-popup-close",function(e){
	e.preventDefault();
	closePopup();
	});


	$(".addLink").click(function(e) {
		 
	e.preventDefault();
	screenW = screen.width;
	screenH = screen.height;
	var lid= ($(this).attr("id")).substr(4);
	GLOBALS_VARS.curr_lid=lid;
	$("#catalogs-popup").css("top","80px;");
	$("#catalogs-popup").css("left", ((screenW/2)-175)+"px" );
	$("#catalogs-popup").css("visibility","visible");
	$(".blank").css("visibility","visible");
	});
	

	//bookmarklet:
	
	var elem= $("#bookmarklet");
	elem.click(function() {
		//bookmarklet
		event.preventDefault();
		alert('Przeciągnij i upuść ten przycisk na pasek swoich zakładek!');
	});


	
	$('.loptions').bind('click', function() {
		event.preventDefault();
		console.log($(this).attr("id"));
		$('#cl_popup').css('visibility','visible');
	});
	
	
	var closePopup = function(){
		$("#catalogs-popup").css("visibility","hidden");
		$(".blank").css("visibility","hidden");
		
	}
 
	
	$(document).keyup(function(e) { 
		  if (e.keyCode == 27) { closePopup(); }   // esc
		});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});




 