$(document).ready(function() {
	$('.toggle').on('click', function () {
		let checked = $(this).siblings('.cbx').prop('checked');
		let hiddenInput = $(this).parent('div').siblings('.hidden-status');
		if (checked) {
			hiddenInput.val('0');
		} else {
			hiddenInput.val('1');
		}
	});

	$('.select-on-check-all').on('click', function () {
		let isChecked = false;
		if (!$(this).prop('checked')) {
			$('.table-cbx').each(function (index, value) {
				$(this).prop('checked', false);
			});
		}
	});

	$('.table-cbx').on('click', function () {
		let isChecked = false;
		$('.table-cbx').each(function (index, value) {
			if ($(this).prop('checked')) {
				isChecked = true;
			}
		});
		if (isChecked) {
			$('.edit-block').css('display', 'initial');
		} else {
			$('.edit-block').css('display', 'none');
		}
	});

	//Enable save button after input change
	$('.grid-input').on('input', function () {
		$('.custom-save-button').prop('disabled', false);
	});

	//Debug panel: actions
	$('.debug-panel-index').on('click', function () {
		$.get(
			'/user/backend/default/debuger',
			'action=robots'
		)
			.done(function(result) {
				if (result) {
					$('.debug-modal-info').text('Индексация включена. Сайт доступен для поиска в сети.');
				} else {
					$('.debug-modal-info').text('Индексация отключена. Сайт не доступен для поиска в сети.');
				}
				$('#debug-modal').modal();
			});
	});

	$('.debug-panel-debug').on('click', function () {
		$.get(
			'/user/backend/default/debuger',
			'action=debug'
		)
			.done(function(result) {
				if (result) {
					$('.debug-modal-info').text('Debug-панель активирована. Она видна всем посетителям сайта');
					$('#debug-modal').modal();
				}
				//$('.debug-panel-index').siblings('#cbx-index').prop('checked', result);
			});
	});

	$('.debug-modal-close').on('click', function () {
		$('#debug-modal').modal('hide');
	});

	$('.custom-block-select').on('change', function () {
		if ($(this).val() != -1) {
			$('.custom-addblock-button').prop('disabled', false);
		} else {
			$('.custom-addblock-button').prop('disabled', true);
		}
	});

	$(".input-file").change(function() {
		var f_name = [];
		for (var i = 0; i < $(this).get(0).files.length; ++i) {
			f_name.push(" " + $(this).get(0).files[i].name);
		}
		$(".input-file-fake").val(f_name.join(", "));
	});

	$(".input-file-search").on('click', function() {
		$('.input-file').click();
	});

	$(".input-file").siblings('.help-block').bind('DOMSubtreeModified', function() {
		var error = $(this).text();
		if ($('div').is('.error-file')) {
			$('.error-file').text(error);
		} else {
			$(this).parent('div').parent('div').append('<div class="error-file">' + error + '</div>');
		}
	});

	$(".input-file-gallery").change(function() {
		var f_name = [];
		for (var i = 0; i < $(this).get(0).files.length; ++i) {
			f_name.push(" " + $(this).get(0).files[i].name);
		}
		$(".input-file-fake-gallery").val(f_name.join(", "));
	});

	$(".input-file-search-gallery").on('click', function() {
		$('.input-file-gallery').click();
	});

	var selected = [];
	// load all selected options in array when the mouse pointer hovers the select box
	$('.multiple-select').on('click', function() {
		if (this.multiple == true) {
			for (var i = 0, a = selected.length; i < this.options.length; i++) {
				if (this.options[i].selected == true) {
					if (selected.indexOf(this.options[i].value) != -1) {
						this.options[i].selected = false;
						selected.splice(selected.indexOf(this.options[i].value), 1);
					} else {
						if (a != (selected.length - 1)) {
							selected[a] = this.options[i].value;
						}
						a++;
					}
				}
			}

			for(var i = 0; i < selected.length; i++) {
				for(var j = 0; j < this.options.length; j++) {
					if (selected[i] == this.options[j].value) {
						this.options[j].selected = true;
					}
				}
			}
		}
	});

	//active menu parent item
	$('.mark-menu-item ul li').each(function(index, element){
		if ($(this).hasClass('active')) {
			$(this).parent('ul').parent('.mark-menu-item').addClass('active');
		}
	});
});

function multiDelete(formId) {
	$('.form-multi-action').val('delete');
	if (confirm('Вы уверены, что хотите удалить эти записи?')) {
		if (formId) {
			$('#' + formId).submit();
		} else {
			$('#update_form').submit();
		}
	} else {
		$('.form-multi-action').val('');
	}
	return false;
}

function multiCopy(formId) {
	$('.form-multi-action').val('copy');
	if (confirm('Вы уверены, что хотите дублировать эти записи?')) {
		if (formId) {
			$('#' + formId).submit();
		} else {
			$('#update_form').submit();
		}
	} else {
		$('.form-multi-action').val('');
	}
	return false;
}

/* $(document).ready(function(){
	redactorInit();
});

function redactorInit(){
	$('.editor').redactor({
		lang: 'ru',
		//plugins: ['fontcolor', 'fontfamily', 'fontsize', 'fullscreen'],
		observeLinks: true,
		convertVideoLinks: true,
		convertImageLinks: true,
		imageUpload: '/liteedit/load_image_in_text',
		fileUpload: '/liteedit/load_file_in_text'
	});
} */

$(function () {
	$('[data-toggle="tooltip"]').tooltip();
});

function deleteImage(module, contentId, fileName, fileId){
	if(confirm('Вы уверены, что хотите удалить это изображение?')){
		
		$.post(
			'/preadmin/delete-image',
			'module=' + module + '&contentId=' + contentId + '&fileName=' + fileName + '&fileId=' + fileId
		)
		.done(function(result) {
			if(result == 'success') {
				$('#'+module+'_'+contentId+'_'+fileId+'_imageblock').hide();
			}
		});
	}
	return false;
}

// function multiDelete(){
// 	if(confirm('Вы уверены, что хотите удалить?')){
//
// 		$.post(
// 			'/preadmin/multi-delete',
// 			$('#update_form').serialize()
// 		)
// 		.done(function(result){
// 		});
// 	}
// 	return false;
// }

/********** Массовое редактирование(удаление) материалов ***********/
function multiUpdate(formId){
	if(formId){
		$('#'+formId).submit();
	} else {
		$('#update_form').submit();
	}
	return false;
}

function multiUpdateLite(formId = 'update_form'){
	$('#'+formId).submit();
	return false;
}

/********** Переключатель статуса материала ***********/
$('.switcher').click(function(){
	if($(this).hasClass('on')) {
		$(this).removeClass('label-success');
		$(this).removeClass('on');
		$(this).addClass('off');
		$(this).addClass('label-default');
		$(this).attr('title', 'Активировать');
		$(this).text('Отключен');
		$($(this).next()).attr('value', 0);
	} else if($(this).hasClass('off')) {
		$(this).removeClass('label-default');
		$(this).removeClass('off');
		$(this).addClass('on');
		$(this).addClass('label-success');
		$(this).attr('title', 'Отключить');
		$(this).text('Активен');
		$($(this).next()).attr('value', 1);
	}
});