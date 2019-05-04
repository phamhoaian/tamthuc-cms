$(function(){

	var profileUpload = $('#profile-upload-crop').croppie({
        enableExif: true,
        viewport: {
            width: 250,
            height: 250,
            type: 'circle'
        },
        boundary: {
            width: 320,
            height: 320
        },
        enableOrientation: true
    });

    var topPicUpload = $('#top-pic-upload-crop').croppie({
        enableExif: true,
        viewport: {
            width: 280,
            height: 158,
        },
        boundary: {
            width: 320,
            height: 180
        },
        enableOrientation: true
    });

    var coinCardUpload = $('#coin-card-upload-crop').croppie({
        enableExif: true,
        viewport: {
            width: 280,
            height: 174,
        },
        boundary: {
            width: 320,
            height: 199
        },
        enableOrientation: true
    });

    var postEyeCatching = $('#post-eye-catching-crop').croppie({
        enableExif: true,
        viewport: {
            width: 280,
            height: 229,
        },
        boundary: {
            width: 320,
            height: 261
        },
    	enableOrientation: true
    });

    var contentEyeCatching = $('#content-eye-catching-crop').croppie({
        enableExif: true,
        viewport: {
            width: 280,
            height: 229,
        },
        boundary: {
            width: 320,
            height: 261
        },
        enableOrientation: true
    });

	$(document).on('dragenter', function (e) 
	{
		e.stopPropagation();
		e.preventDefault();
	});

	$(document).on('dragover', function (e) 
	{
	  e.stopPropagation();
	  e.preventDefault();
	  $('.drap-and-drop').css('border', '1px dotted #0B85A1');
	});

	$(document).on('drop', function (e) 
	{
		e.stopPropagation();
		e.preventDefault();
	});

	$(document).on('dragover', '.drap-and-drop', function (e) {
		e.stopPropagation();
		e.preventDefault();
		$(this).css('border', '2px solid #0B85A1');
	});

	$(document).on('drop', '.drap-and-drop', function(e){
		e.preventDefault();
		var files = e.originalEvent.dataTransfer.files;
		var obj_fileOpener = $(this).data('file-id');
		document.getElementById(obj_fileOpener).files = files;
		$(this).find('.upload-file:not(:disabled)').trigger('change');
	});

	$(document).on('change', '.upload-file:not(:disabled)', function (e) {
		e.preventDefault();
		$(this).css('border', '1px solid #0B85A1');

		// get file uploaded
		var files = $(this).prop('files');

		// get object used to show preview file
		var obj_preview = $(this).data('preview-id');
		obj_preview = $("#" + obj_preview);
		obj_preview.prop('src', '');

		// validate file upload
		if (checkExt(files, obj_preview)) {
			if (checkSize(files, obj_preview)) {
				// get crop variable
				var crop = $(this).data('crop');
				if ( typeof(crop) === "undefined" || crop === null ) {
					$(this).closest('.drap-and-drop').addClass('opened');
					$(this).closest('.uploading').addClass('opened');
				}

				readFile(this, obj_preview, crop);
			}
			else {
				//clear file if validate failed
				$(this).val('');
			}
		}
		else {
			//clear file if validate failed
			$(this).val('');
		}
	});

	$(document).on('click', '.preview-area .remove', function(){
		var uploading = $(this).closest('.uploading');
		uploading.removeClass('opened');
		var preview_wrap = uploading.find('.preview-wrap').removeClass('opened');
		var drap_drop = uploading.find('.drap-and-drop').removeClass('opened');
		var input = drap_drop.find('.upload-file').val('');
		setTimeout(function(){
			var obj_img = preview_wrap.find('img').remove();
		}, 1000);
	});

	$(document).on('click', '.upload-result', function (e) {
		var cropTarget = $(this).attr('data-crop-target');
		var previewTarget = $(this).attr('data-preview-target');
		previewTarget = $("#" + previewTarget);
		eval(cropTarget).croppie('result', {
			type: 'canvas',
			size: 'original'
		}).then(function (res) {
			output(previewTarget, {
				src: res
			});
			$('#imgbase64_' + cropTarget).val(res);
			$('#upload-modal').modal('hide');
			var parent = previewTarget.closest('.uploading');
			parent.addClass('opened');
			parent.find('.drap-and-drop').addClass('opened');
			// reset recently model
			$('input[name*="recently_model"]').val('');
			$('input[name*="recently_model_id"]').val('');
		});
	});

	$(document).on('click', '.croppie-rotate', function(ev) {
		var cropTarget = $(this).attr('data-crop-target');
		eval(cropTarget).croppie('rotate', parseInt($(this).data('deg')));
	});

	$(document).on('click', '#upload-modal .btn-close', function(){
		var inputTarget = $(this).attr('data-input-target');
		$('#' + inputTarget).val('');
	});

	function readFile(input, element, crop = null) {
		if (input.files && input.files[0]) {
			var type = input.files[0].type;
			type = type.split("/", 1);
	        var fr = window.URL.createObjectURL(input.files[0]);

	        switch (type[0]) {
	        	case "image":
	        		if ( typeof(crop) !== "undefined" && crop !== null ) { // case of cropping is enabled
	        			$('#upload-modal').modal('show');
	        			$('#upload-modal').find('.croppie').hide();
	        			$('#upload-modal').find('.upload-result').attr('data-crop-target', crop).attr('data-preview-target', element.attr('id'));
	        			$('#upload-modal').find('.croppie-rotate').attr('data-crop-target', crop);
	        			$('#upload-modal').find('.btn-close').attr('data-input-target', input.getAttribute('id'));
						var reader = new FileReader();
			            reader.onload = function (e) {
			            	eval(crop).show();
			            	eval(crop).croppie('bind', {
			            		url: e.target.result
			            	});
			            	
			            }
			            reader.readAsDataURL(input.files[0]);
	        		} else { // case of cropping is disabled
	        			obj = document.createElement('img');
						obj.src = fr;
						output(element, {
							html: obj
						});
	        		}
					break;
	    		case "audio":
					obj = document.createElement('audio');
					obj.src = fr;
					obj.controls = true;
					output(element, {
						html: obj
					});
					break;
				case "video":
					obj = document.createElement('video');
					obj.src = fr;
					obj.controls = true;
					output(element, {
						html: obj
					});
					break;
				default:
					obj = document.createElement('object');
					obj.data = fr;
					obj.height = 208;
					output(element, {
						html: obj
					});
					break;
	        }
	    }
	    return;
	}

	function output(node, result) {
		var html;
		if (result.html) {
			html = result.html;
		}
		if (result.src) {
			html = '<img src="' + result.src + '" />';
		}
		node.html(html);
		node.addClass('opened');
	}

	function checkExt(files, obj_img){
		if (files===null) {
			return true;
		}
		$(obj_img).parents('.uploading').siblings('.error-message').remove();
		var file = files[0];
		var name = file.name;
		var dotPos = name.lastIndexOf('.');
		var ext = '';
		if(dotPos >= 0) {
			var ext = name.substr(dotPos+1);
			ext = ext.toLowerCase();
		}
		//image
		var allowImg = ['bmp', 'jpg', 'jpeg', 'png', 'gif'];
		//audio
		var allowAudio = ['mp3', 'wma', 'wav'];
		//video
		var allowVideo = ['mp4', 'wmv', 'avi', 'mov'];
		//pdf
		var allowPdf = ['pdf'];
		
		var allowExts = ['bmp', 'jpg', 'jpeg', 'png', 'gif', 'mp3', 'wma', 'wav', 'mp4', 'wmv', 'avi', 'mov', 'pdf'];
		
		var dataType = $(obj_img).attr('data-type');

		if(dataType == 'image'){
			allowExts = allowImg;
		}
		else if(dataType == 'audio') {
			allowExts = allowAudio;
		}
		else if(dataType == 'video') {
			allowExts = allowVideo;
		}
		else if(dataType == 'pdf') {
			allowExts = allowPdf;
		}


		var selector_id = $(obj_img).attr('id');
		var position_err = $(obj_img).attr('error-pos');
		if(allowExts.indexOf(ext) < 0 ) {
			//show error
			if(position_err == 'below'){
				$(obj_img).parents('.uploading').after('<div class="error-message">' +messagesExt[selector_id]+ '</div>');
			}
			else{
				$(obj_img).parents('.uploading').before('<div class="error-message">' +messagesExt[selector_id]+ '</div>');
			}
			return false;
		}
		return true;
	}

	function checkSize(files, obj_img) {
		if (files===null) {
			return true;
		}
		$(obj_img).parents('dl').find('dt').find('.error-message').remove();
		var file = files[0];
		var name = file.name;
		var dotPos = name.lastIndexOf('.');
		var ext = '';
		if (dotPos >= 0) {
			var ext = name.substr(dotPos + 1);
			ext = ext.toLowerCase();
		}
		var allowVideoExts = ['mp4', 'wmv', 'avi', 'mov'];
		var size = file.size;
		var limit_size = 1024 * 1024 * 1024;
		var selector_id = $(obj_img).attr('id');
		
		if (parseInt(size) > parseInt(limit_size)) {
			//show error
			$(obj_img).parents('dl').find('dt').append('<div class="error-message">' +messagesExceed[selector_id]+ '</div>');
			return false;
		}
		return true;
	}
});
