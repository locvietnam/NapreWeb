/**
*  Filename    : Update Custom
*  Author      : Tuan Nguyen
*  Author URL  : http://tuannguyenblog.info
*  Date Create : 200617
*/

/*----------------------------------
* Load Funtion
*---------------------------------*/

$(document).ready(function() {
	hoverBgColor('.hover-purple', 'bg-purple');
	hoverBgColor('.hover-danger', 'bg-danger');

	handerEditCategory();
	
});

// Hander hover change background color
function hoverBgColor($class, $bgColor) {
	var $this = $($class);
	var $bgColor = $bgColor;
	$this.hover( function() {
		$(this).addClass($bgColor);
	}, function() {
		$(this).removeClass($bgColor);
	});
}

// Hander edit category
function handerEditCategory(){
	$('.box-category').each(function() {
		var $cateName 	= $('.category-name', $(this)); 
		var $click 		= $('.group-btn .edit', $(this));
		//lchung add
		var cate_id = 0;
		$click.click(function(){
			var dataName = $cateName.text();
			$cateName.html('');
			
			//lchung add
			cate_id = $(this).data('id');

			$('<input></input>')
			.attr({
				'type': 'text',
				'name': 'fname',
				'data-id': cate_id,
				'onBlur': 'updateCate(this, event)',
				'class': 'form-control txt_fullname',
				'size': '30',
				'value': dataName
			})
			.appendTo($cateName);
			$('.txt_fullname').focus();
		});
		//lchung comment
		/*$(document).on('blur','.txt_fullname', function(){
			var name = $(this).val();
			alert( $(this).data('id') )
			$(this).closest("h4").text(name);
		});*/
	
	});
}

//lchung add
function updateCate(obj, e){
	var name = $(obj).val();
	var notempty = $(obj).closest("h4").data('notempty');
	var id = $(obj).data('id');
	
	$(obj).closest("h4").text(name);
	
	if( name == '' ){
		///alert( notempty );
		return false;
	}
	
	$.ajax({
			url: base_url_admin + '/checklist/updateCate',
		type: 'POST',
		data: {'checklist_category': name, 'id': id},
		//this is the dataType    
		dataType: 'json',
		success: function (results) {
			///document.location.reload( true );
		}
	});
}

