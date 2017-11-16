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

		$click.click(function(){
			var dataName = $cateName.text();
			$cateName.html('');

			$('<input></input>')
			.attr({
				'type': 'text',
				'name': 'fname',
				'class': 'txt_fullname',
				'size': '30',
				'value': dataName
			})
			.appendTo($cateName);
			$('.txt_fullname').focus();
		});
		$(document).on('blur','.txt_fullname', function(){
			var name = $(this).val();
			$(this).closest("h4").text(name);
		});
	
	});
}