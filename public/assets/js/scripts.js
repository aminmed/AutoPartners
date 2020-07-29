(function(window, undefined) {
  'use strict';

 	$(document).on('click', '#submit', function(){
 		var form = $(this).parents('form:first');
 		var url = form.data("url");
 		var data = new FormData($(form)[0]);
		form.find("button#submit").attr("disabled", false);
		form.find("button#submit i").addClass("ft-refresh-cw spinner");
		$.ajax({
			url: url,
			type: 'post',
			contentType: false,
            processData: false,
			data: data,
			async: false,
			success: function(data) {
				form.find('div.form-group input, div.form-group textarea, div.form-group select, div.tagsinput').removeClass('is-invalid text-danger');
				form.find("span.select2").removeClass("border-red");
				form.find('div.form-group div.form-control-position i').removeClass('danger');
				form.find('div.form-group div.row label').removeClass('danger');
				form.find('div.form-group ul.text-danger').remove();
				if (data.status == "error") {
					$.each(data.errors, function(x, array) {
						x = x.replace(".", "_");
						form.find('input#'+x+', textarea#'+x+', select#'+x+', div.tagsinput #'+x).addClass('is-invalid text-danger');
						form.find('div#'+x+' span.select2').addClass("border-red");
						form.find('div#'+x+' div.form-control-position i').addClass('danger');
						form.find('div#'+x+' div.row label').addClass('danger');
						form.find('div#'+x+' div.form-control-position').after('<ul class="text-danger"></ul>');
						$.each(array, function(Y, text) {
							form.find('div#'+x+' ul.text-danger').append('<li>'+text+'</li>');
						});
					});
					console.log(data); 
					toastr.error(data.message, '' , {positionClass: 'toast-top-'+HeadPosition, containerId: 'toast-top-'+HeadPosition });
				}else {
        			toastr.success(data.message, '' , {positionClass: 'toast-top-'+HeadPosition, containerId: 'toast-top-'+HeadPosition });
    				if (data.url != null) {
				        setTimeout(
				        	function(){
				        		location.href=''+data.url+''
				        	} , 500
				        );
				    }
				}
				form.find("button#submit").attr("disabled", false);
				form.find("button#submit i").removeClass("ft-refresh-cw spinner");
			},
			error: function(data) {
        		toastr.error(HeadServer, '' , {positionClass: 'toast-top-'+HeadPosition, containerId: 'toast-top-'+HeadPosition });
        		console.log(data);
			}
		});
		return false;
	});

  	function functionUrl(url){
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: "post",
			success: function(data) {
				$('#pageContents').html(data);
				window.history.pushState({href: url}, '', url);
			},
			error: function(data) {
		        toastr.error(HeadServer, '' , {positionClass: 'toast-top-'+HeadPosition, containerId: 'toast-top-'+HeadPosition });
			}
		});
		return false;
	};
 	$(document).on('click', '#urlChange', function(){
 		functionUrl($(this).data("url"));
 	});
 	$(document).on('change', '#urlSelect', function(){
 		functionUrl($(this).find(':selected').data("url"));
 	});
  	$(document).on('click', '#urlSearch', function(){
 		functionUrl($(this).data("url") + $(".search").val());
 	});
   	$(document).on('change', '#urlDate', function(){
 		functionUrl($(this).data("url") + $(this).val());
 	});

	$(document).on('click', '.pagination a', function(event){
		event.preventDefault(); 
		functionUrl($(this).attr('href'));
	});

 	$(document).on('click', '#option', function(){
 		var url = $(this).data("url");
 		var id = $(this).data("id");
 		var page = $(this).data("page");
 		var div = $(this).data("div");
 		var message = $(this).data("message");

		swal({
		    title: "Confirmation",
		    text: "êtes-vous sûr de vouloir "+message+"?",
		    icon: "warning",
		    buttons: {
	            cancel: {
	                text: "Non",
	                value: null,
	                visible: true,
	                closeModal: true
	            },
	            confirm: {
	                text: "Oui",
	                value: true,
	                visible: true,
	                closeModal: true
	            }
		    }
		}).then(isConfirm => {
		    if(isConfirm) {
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: url,
					type: 'post',
					dataType: "json",
					success: function(data) {
						if (data.status == "error") {
		        			toastr.error(data.message, '' , {positionClass: 'toast-top-'+HeadPosition, containerId: 'toast-top-'+HeadPosition });
						}else {
							if (page == "list") {
								$('#'+div+'-'+id).addClass("bg-danger");
								$('#'+div+'-'+id).fadeOut(
									1000, function() {
										$(this).remove();
									}
								);
							}
							toastr.success(data.message, '', {positionClass: 'toast-top-'+HeadPosition, containerId: 'toast-top-'+HeadPosition});
							if (page == "show") {
						        setTimeout(
						        	function(){
						        		location.href=''+data.url+''
						        	} , 1000
						        );
						    }
						}
					},
					error: function(data) {
						toastr.error(HeadServer, '', {positionClass:'toast-top-'+HeadPosition, containerId:'toast-top-'+HeadPosition});
						console.log(data);
					}
				});
		    }
		});
	});

	$(document).on('change', '#imageinput', function(e){
		var input     = $(this);
		var name      = input.attr('name');
		var url       = input.data('url');
		var id        = input.data('id');
		var width     = input.data('width');
		var height    = input.data('height');
		var folder    = input.data('folder');
		var work      = input.data('work');
		var file      = e.target.files[0];

		var formGroup = input.closest('div.form-group');

		var data      = new FormData();
		data.append('image', file);
		data.append('width', width);
		data.append('height', height);
		data.append('folder', folder);
		data.append('work', work);

		input.attr("disabled", true);
		formGroup.find("span.btn i").removeClass("ft-upload").addClass("ft-refresh-cw spinner");

		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url: url,
			type: 'post',
			contentType: false,
            processData: false,
			data: data,
			async: false,
			success: function(data) {
				if (data.status == "error") {
					toastr.error(data.message, '', {positionClass: 'toast-top-'+HeadPosition, containerId: 'toast-top-'+HeadPosition});
				}else {
					if (work === true) {
						formGroup.find("#images").append(data.html);
					}else {
	        			formGroup.find("img").attr("src", data.image);
	        			formGroup.find("#"+id).val(data.image);
        			}
				}
				input.attr("disabled", false);
				formGroup.find("span.btn i").removeClass("ft-refresh-cw spinner").addClass("ft-upload");
				input.val("");
				console.log(data);
			},
			error: function(data) {
        		toastr.error(HeadServer, '', {positionClass:'toast-top-'+HeadPosition, containerId:'toast-top-'+HeadPosition});
        		console.log(data);
			}
		});
		return false;
	});

})(window);

function generate(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@/*-';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}