/**
 *  Filename    : Script Custom
 *  Author      : Tuan Nguyen
 *  Author URL  : http://tuannguyenblog.info
 *  Date Create : 090617
 */

/*----------------------------------
 * Load Funtion
 *---------------------------------*/
$(document).ready(function() {
    var screen = $(window).width();

    // Hover Image for All Pages
    hoverJS();

    // Check item
    checkList('.checklist li label');
    checkList('.checkbox label');
    checkList('.list-users .item-user label');

    // Check all
    clickCheckAll('.checkAll', '.item-user', 'input');

    filterResultSearch();

    // Forward Staff
    forwardStaff();

    // Amination
    $('.create-checklist .box').each(function() {
        var $thisParent = $(this);
        $('.group-btn .delete-category', $thisParent).click(function() {
            $(this).toggleClass('active');

            if ($(this).hasClass('active')) {
                $('.box-body li .icon-delete', $thisParent).fadeIn(300);
                $('.box-body li label', $thisParent).animate({
                        'padding-left': '50px',
                    },
                    300
                );
            } else {
                $('.box-body li .icon-delete', $thisParent).fadeOut(300);
                $('.box-body li label', $thisParent).animate({
                        'padding-left': '0',
                    },
                    300
                );
            }
        });
    });

    // Set modal center
    $('.modal').on('show.bs.modal', function() {
        $(this).show();
        setModalMaxHeight(this);
    });

    $(window).resize(function() {
        if ($('.modal.in').length != 0) {
            setModalMaxHeight($('.modal.in'));
        }
    });

    // Fix Menu in mobile screen when scroll
    if (screen < 767) {
        scrollFixMenu($('.main-header .navbar'), 50);
    }
});

/*----------------------------------
 * FUNCTION
 *---------------------------------*/

// HoverJS
function hoverJS() {
    $('.hoverJS').hover(
        function() {
            $(this).stop().fadeTo(100, 0.8);
        },
        function() {
            $(this).stop().fadeTo(100, 1);
        }
    );
}

// Checklist
function checkList(el) {
    $(el).parent().each(function() {
        var $check = $('input[type="checkbox"], input[type="radio"]', $(this));
        if ($check.is(':checked')) {
            $check.next().addClass('active');
        }
    });

    $(el).click(function() {
        //  Type input
        var $type = $(this).prev();
        if ($type.is("input[type='checkbox']")) {
            if ($type.attr('checked')) {
                $type.removeAttr('checked');
				$type.prop('checked', false);
                $type.next().removeClass('active');
            } else {
                ///$type.attr('checked', 'checked');
				//lchung add
				$type.attr('checked', 'checked').next().addClass('active');
				$type.prop('checked');
               /// $type.next().addClass('active');
            }
        }

        if ($type.is("input[type='radio']")) {
            $(el).parent().each(function() {
                var $check = $('input[type="radio"]', $(this));
				//lchung add
				$check.removeAttr('checked');
				$check.next().removeClass('active');
				/*
                if ($check.attr('checked')) {
                    $check.removeAttr('checked');
                    $check.next().removeClass('active');
                }*/
            });

            ///$type.attr('checked', 'checked');
			//lchung add
			$type.prop('checked', true);
            $type.next().addClass('active');
			//lchung add set again department name to [Forward to department -> department]
			if( $type.next().hasClass('active') ){
				$('.farrangement-table .department-name-to').text( $type.next().children('span').text() );
			}
        }
    });
}

// Check All
function clickCheckAll($elClick, $elEach, $elActive) {
    $($elClick).click(function() {
        var $this = $(this);
        $this.toggleClass('active');

        if ($this.hasClass('active')) {
            $($elEach).each(function() {
                var $check = $($elActive, $(this));
                $check.attr('checked', 'checked').next().addClass('active');
				//lchung add
				$check.prop('checked', true);//.next().addClass('active');
				
            });
        } else {
            $($elEach).each(function() {
                var $check = $($elActive, $(this));
                $check.removeAttr('checked').next().removeClass('active');
            });
        }
    });
}

// Modal Forward Staff
function forwardStaff() {
    var $el = $('.modal-body-content');

    $('body').find('#modalForward').on('shown.bs.modal', function(e) {
        $('#modalForward').find('#toggleModalActive').click(function() {
            $el.first().hide();
            $el.last().addClass('show').fadeIn();

            if ($el.last().hasClass('show')) {
                ///$('.modal-title').text('部署'); //lchung comment
                $('.modal-header .close').show();
            }
        });

        $('#modalForward').find('.close').click(function() {
            $el.last().removeClass('show').hide();
            $el.first().fadeIn();

            if (!$el.last().hasClass('show')) {
                //$('.modal-title').text('前田');//lchung comment
                $('.modal-header .close').hide();
            }
        });
    });

    $('body').find('#modalForward').on('hidden.bs.modal', function(e) {
        $el.last().removeClass('show').hide();
        $el.first().fadeIn();

        if ($el.last().hasClass('show')) {
            ///$('.modal-title').text('前田');//lchung comment
            $('.modal-header .close').hide();
        }
    });
}

// Set height modal in mobile screen
function setModalMaxHeight(element) {
    this.$element = $(element);
    this.$content = this.$element.find('.modal-content');
    var borderWidth = this.$content.outerHeight() - this.$content.innerHeight();
    var dialogMargin = $(window).width() < 768 ? 20 : 60;
    var contentHeight = $(window).height() - (dialogMargin + borderWidth);
    var headerHeight = this.$element.find('.modal-header').outerHeight() || 0;
    var footerHeight = this.$element.find('.modal-footer').outerHeight() || 0;
    var maxHeight = contentHeight - (headerHeight + footerHeight);

    this.$content.css({
        overflow: 'hidden',
    });

    this.$element.find('.modal-body').css({
        'max-height': maxHeight,
        'overflow-y': 'auto',
    });
}

// Scroll fix nav in mobile screen
function scrollFixMenu($el, $position) {
    $(window).scroll(function() {
        var scroll_w = $(this).scrollTop();

        if (scroll_w > $position) {
            $el.removeClass('navbar-static-top');
            $el.addClass('navbar-fixed-top');
            $('.main-sidebar').addClass('main-sidebar-fixed');
        } else {
            $el.addClass('navbar-static-top');
            $el.removeClass('navbar-fixed-top');
            $('.main-sidebar').removeClass('main-sidebar-fixed');
        }
    });
}

// Input Search Filter
function filterResultSearch() {
    var data = [];
    $('body').find('.list-users .item-user').each(function () {
        var upid = $(this).attr('id');
        data.push(upid);
    });
    $('input.search').keyup(function (e) {

        var sv = $(this).val(); 
        for (var i = 0; i < data.length; i++) {
            
            var tupid = data[i]; 
            var re = new RegExp(sv, "gi"); 
            var check = tupid.match(re); 
            var theid = '#'+tupid;   

            if (Array.isArray(check) === false) {  
                $(theid).fadeOut('fast');
            }else{
                $(theid).fadeIn('fast');
            }
        }
    });
}