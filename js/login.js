// JavaScript Document

$(document).ready(function() {
			$("#form-login").validate({
				rules: {
				password			: {
          	 						required	: true,
									minlength	: 5,
									maxlength	: 15,
          					   		},
				username		: 	{
          	 						required	: true,
					   				number		: true,
									minlength	: 5,
									maxlength	: 5,
          					   		}
				

				},
			
      	messages: { 
			  
		      	username		:	{
				    				required	: '. Harus di isi',
				    				number		: '. Hanya Angka',
									minlength	: '. Minimal 5 Digit',
									maxlength	: '. Maximal 5 Digit'
			    					},
				
				password			:	{
				    				required	: '. Harus di isi',
									minlength	: '. Minimal 5 Digit',
									maxlength	: '. Maximal 15 Digit'
			    					},
				
			  

			   },
         
         success: function(label) {
            label.text('OK!').addClass('valid');
         }
			});
		});