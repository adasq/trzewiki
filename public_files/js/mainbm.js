


var ASHER_SCRIPT = {
	base_url: 'http://localhost/testy',
	closeTimeout: 3000,
	wait: 'Czekaj...',
	asher_dom: null,	
	currentAction: null,
	currentShare: null,
	query: {action: null, share: null, tags:null },
	
	stopTimeout: function(){ 
		
		if(typeof(ASHER_TIMEOUT) != 'undefined'){
			clearTimeout(ASHER_TIMEOUT);
		}
	},
	
//dom manipulate
    setDom: function(dom) {
	this.asher_dom= dom;
    },
	
    createDom: function() {
			if(this.asher_dom!=null){							
				this.deleteDom();	
						
				var newelem= document.createElement('div'); 
				newelem.id='asher';  
				newelem.innerHTML=this.asher_dom.style_element + this.asher_dom.topbar_element;
				document.body.appendChild(newelem);					
			return true;
			}else{
			return false;
			}
    },
	
	deleteDom: function(){	
			var oldelem = document.getElementById('asher'); 
			return oldelem && document.body.removeChild(oldelem);	
	},
	
	
	
//click actions:	
	onClickAction: function(e){
		  e.preventDefault();
		  var arr= this.id.split('-');
		  var func=arr[0];
		  var type=arr[1]; 
		  if(func=='action'){
			  
			  //focus na tag input, jeśli użytkownik chce dodać link do katalogów
			  if(!isNaN(type)){		  document.getElementById('asher-tags').focus();		  }
			 
			  
					  if(ASHER_SCRIPT.currentAction)ASHER_SCRIPT.currentAction.classList.remove('asher-submit');
					  this.classList.add('asher-submit');
					  ASHER_SCRIPT.currentAction=this;
					  ASHER_SCRIPT.query.action = type;
				  }else if(func=='share'){
					  if( ASHER_SCRIPT.currentShare)ASHER_SCRIPT.currentShare.classList.remove('asher-submit');
					  this.classList.add('asher-submit');
					  ASHER_SCRIPT.currentShare=this;
					  ASHER_SCRIPT.query.share = type;
					  
			}
		if(ASHER_SCRIPT.query.action && ASHER_SCRIPT.query.share){ 

			ASHER_SCRIPT.sendRequest(); 
			}  
	},
	openLoginWindow: function(e){
		e.preventDefault();
		window.open(ASHER_SCRIPT.base_url+'/login','login','width=500,height=360,scrollbars=yes,resizable=yes,left='+(screen.availWidth/2-400)+',top='+(screen.availHeight/2-335)+'');	
		ASHER_SCRIPT.deleteDom();
	},
//request, response
	sendRequest: function(){

		ASHER_RESPONSE=null;
		
		var expression = /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&\/\/=]*)?/gi;
		var regex = new RegExp(expression);
		var t = document.URL;
		  if (t.match(regex) )
		 { 			  
		  
			  this.query.tags = document.getElementById('asher-tags').value.replace(/(?:(?:^|\n)\s+|\s+(?:$|\n))/g,'').replace(/\s+/g,' ');
		
		  document.getElementById('asher-inner').innerHTML=this.asher_dom.getInfoElement(this.wait);
			
  
		  var baseurl=ASHER_SCRIPT.base_url+"/add";
		 
		  var fullquery=
		  "?a="+ this.query.action+
		  "&h="+this.asher_dom.hash+
		  "&s="+ this.query.share+
		  "&u="+encodeURIComponent(document.URL)+
		  ( this.query.tags?'&t='+encodeURIComponent( this.query.tags):'');
	
		  var url=baseurl+fullquery;
 
		  var head = document.getElementsByTagName("head")[0];
		  var done = false;
		  var script = document.createElement("script");
		  script.src = url;
		  script.onload = script.onreadystatechange = function(){
		  	if ( !done && (!this.readyState ||
		  			this.readyState == "loaded" || this.readyState == "complete") ) {
		  		done = true;
		  		ASHER_SCRIPT.gotResponse();
		  	}
		  };
		  head.appendChild(script);
		 //end of get script
		 
		 } else {
		  // alert("not url");
		 }

	   },//sendRequest
	
	   gotResponse: function(){
 
		   console.log(ASHER_RESPONSE);
		   
		   
		   if(!ASHER_RESPONSE.login){
		 	  document.getElementById('asher-inner').innerHTML=this.asher_dom.login_element;	 	  	
		 	 document.getElementById('asher-loginbtn').onclick=this.openLoginWindow;				
		   	  
		   }else{
			   console.log(ASHER_RESPONSE.status);
		 	  document.getElementById('asher-inner').innerHTML=this.asher_dom.getInfoElement(ASHER_RESPONSE.status);
		 	  
		 	 
		 	 ASHER_TIMEOUT =setTimeout( this.deleteDom  , this.closeTimeout);
//		 	 ASHER_SCRIPT.timeoutObj= setTimeout( this.deleteDom  , this.closeTimeout);
//		 	 console.log("!!!!!");
//		 	 console.log(ASHER_SCRIPT.timeoutObj);
		   }
		   
		   
	  },
	  
//init:	  
	  
	  init: function(){
		  
		  //utworzenie obiektu:
		  ASHER_SCRIPT.createDom();  
		  var buttons = document.getElementsByName("asher-option");
		  for (var i=0;i<buttons.length;i++)
		  { 
			  buttons[i].onclick=this.onClickAction;
		  }		  
		  document.getElementById("asher-close").onclick=function(e){e.preventDefault(); ASHER_SCRIPT.deleteDom();};
		  
		var asheradd =document.getElementById("asher-function");
		var asheraddul =document.getElementById("asher-function-ul");
		var ashergroups =document.getElementById("asher-share");
		var ashergroupsul =document.getElementById("asher-share-ul");
		 
		
		
		
		 var na = document.getElementsByName("no-action");
		  for (var i=0;i<na.length;i++)
		  { 
			  na[i].onclick=function(e){e.preventDefault();};
		  }		  
		
		
		
		asheradd.onmouseover= function(){
		asheraddul.style.visibility="visible";
		};
		asheradd.onmouseout= function(){
		asheraddul.style.visibility="hidden";
		};
		ashergroups.onmouseover= function(){
		ashergroupsul.style.visibility="visible";
		};
		ashergroups.onmouseout= function(){
		ashergroupsul.style.visibility="hidden";
		};

	
	  }
	
};



if(typeof(ASHER_SCRIPT) != "object" || typeof(ASHER_DOM) != "object"){
	//err
	//nie dołączono poprawnie skryptu
}else{

	ASHER_SCRIPT.setDom(ASHER_DOM);
	ASHER_SCRIPT.stopTimeout();
	ASHER_SCRIPT.init();
	
}




