var ASHERIEBM= {
url: 'http://localhost/testy/send?u=',
u: null,
mode:'',
width: 960,
height: 500,	
init: function(){


	if((/^https?\:/i).test(this.u)){
		
		window.open(ASHERIEBM.url+escape(this.u),
				 this.mode,
				 'width='+this.width+',height='+this.height+',scrollbars=yes,resizable=yes,left='+(screen.availWidth/2-(this.width/2))+',top='+(screen.availHeight/2-(ASHERIEBM.height/2))+'');	
	}else{
		console.log('Błąd. Nie dodano linku.');
	}
}
}
ASHERIEBM.mode='_blank';

ASHERIEBM.u= (document.URL);
ASHERIEBM.init();
 