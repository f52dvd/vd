(function(){
	var sAgent=window.navigator.userAgent;
	var bIsIE=/MSIE /i.test(sAgent),bIsIos=/iPhone|iPad|ipod/i.test(navigator.userAgent),bIsAndroid=/Android/i.test(navigator.userAgent);
	if(!bIsIos&&!bIsAndroid){
		//PC
          document.writeln("");
		//alert('pc');
		return;	
	}
	if(bIsIos){
		//IOS
		//alert('ios');
		document.writeln("");
		return;	

	}
	if(bIsAndroid){
		//alert('Android');
		//Android
		return;	
	}else{
		return;	
	}

			//
})(); 

