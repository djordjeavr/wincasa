/* plugin_wincasaobjektliste */

var plugin_wincasaobjektliste = function () {	    
 
 	var saveData = (function () {
		const a = document.createElement("a");
		document.body.appendChild(a);
		a.style = "display: none";
		return function (data, fileName) {
			const blob = new Blob([data], {type: "octet/stream"}),  /* application/pdf */
				url = window.URL.createObjectURL(blob);
			a.href = url;
			a.download = fileName;
			a.click();
			window.URL.revokeObjectURL(url);
		};
	}());
 
	var handle_plugin_wincasaobjektliste = function() {		  
	
		function getDocument(full_objektid,callback){

			var lang = 'de';
			if(typeof $("html").attr("lang") !== "undefined"){
				lang = $("html").attr("lang");
			}
			//alert(lang);
			
			$.ajax({
				type: 'POST',
				url: '/api/plugin_wincasaobjektliste/get_document',
				timeout: 5000,
				data: {
					full_objektid: full_objektid,
					langcode: lang,
					z: "50"
				},
				headers: {
					'KEY': 'bc7ab6fa3089938c262d56926333b287652313cf646d04c96fd98ab6d4838d6c',
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				dataType: 'json',
				cache: true,
				async : true,
				success: function (data) {
					
					console.log(data);
					//if (jsondata.success == '1') {
						callback(data.get_document);
					//}
					return false;
				},
				error: function(XMLHttpRequest, textStatus, errorThrown) {
					
					//console.log(JSON.stringify(errorThrown));
					callback('{"msg":"error"}');
				}	
			});		
			
		}	


		
        $( ".plugin_wincasawebalarm_btn_document" ).each(function() {
			
			$(this).click(function(){
				var full_objektid = $(this).attr("rel");
				//alert(full_objektid);
				getDocument(full_objektid,function(json){
					if(json.success == '1'){
						/*console.log(json); */
						//alert(json.token);
						location.href='/download-'+json.token+'';
					}
				});
			});

        });

		var swiper = new Swiper('.swiper-container', {
			slidesPerView: 'auto',
			spaceBetween: 30,
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
		});
	
    }	
	
    return {
        init: function () {
			handle_plugin_wincasaobjektliste();
        }
    };

}();
			
jQuery(document).ready(function() {        
	plugin_wincasaobjektliste.init();
});
