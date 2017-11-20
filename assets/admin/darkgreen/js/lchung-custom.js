$(document).ready(function () {
    $('.lang_values').click(function (e) {
        $('.variables-list label').css({'display': 'block'});
        $('.variables-list input').css({'display': 'none'});

        var id = $(this).data('id');
        $('.lab-' + id).css({'display': 'none'});
        $('#' + id).css({'display': 'block'});
    });

    //department-edit
    $('.department-edit').click(function (e) {
        $('.department-list label').css({'display': 'block'});
        $('.department-list input').css({'display': 'none'});        
        $('.department-list select').css({'display': 'none'});
        
        var id = $(this).data('id');
        $('.lab-' + id).css({'display': 'none'});
        $('#' + id).css({'display': 'block'});
        $('.labh-' + id).css({'display': 'none'});
        $('#hospital_id' + id).css({'display': 'block'});
    });
    //End department-edit

    //deluser
    $('.deluser').click(function (e) {
        if (confirm($(this).data('message'))) {
            var id = $(this).data('id');
            $.ajax({
                url: base_url_admin + '/users/del',
                type: 'GET',
                data: {'id': id},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
    });
    //End deluser

    //fAddLang
    $('#fAddLang').submit(function (e) {

        var id = $(this).val();
        var action = $(this).attr('action');
        var Url = base_url_admin + action;
        var name = $(this).find('#name').val();
        var value = $(this).find('#value').val();
        var lang = $(this).find('#lang option:selected').val();
        if (name == '' || value == '' || lang == '') {
            alert('Please enter the fields has (*)');
        } else {
            $.ajax({
                url: action,
                type: 'POST',
                data: {'name': name, 'value': value, 'lang': lang},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
        return false;
    });
    //End fAddLang

    //fAddLang
    $('#fAddDepartment').submit(function (e) {

        var id = $(this).val();
        var action = $(this).attr('action');
        var Url = base_url_admin + action;
        var name = $(this).find('#name').val();
        var hospital_id = $(this).find('#hospital_id').val();
        if (name == '' || hospital_id == '') {
            alert('Please enter the fields has (*)');
        } else {
            $.ajax({
                url: action,
                type: 'POST',
                data: {'department_name': name, 'hospital_id': hospital_id},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
        return false;
    });
    //End fAddDepartment

    //delete-dep
    var fdelDep = function (id) {
        $.ajax({
            url: base_url_admin + '/department/del',
            type: 'POST',
            data: {'department_id': id, 'confirm': 'yes'},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                document.location.reload(true);
            }
        });
    }
    $('.delete-dep').click(function (e) {
        if (confirm($(this).data('message'))) {
            var id = $(this).data('id');
            $.ajax({
                url: base_url_admin + '/department/del',
                type: 'POST',
                data: {'department_id': id, 'confirm': 'no'},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    if (results.not_error == '') {
                        if (confirm(results.confirm)) {
                            fdelDep(results.id);
                        }
                    } else {
                        document.location.reload(true);
                    }
                }
            });
        }
    });
    //End delete-dep

    //delusermanagerdep
    $('.delusermanagerdep').click(function (e) {
        if (confirm(message_confirm_del)) {
            var departmentid = $(this).data('departmentid');
            var managerid = $(this).data('managerid');
            $.ajax({
                url: base_url_admin + '/department/delusermanagerdep',
                type: 'POST',
                data: {'department_id': departmentid, 'manager_id': managerid},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
    });
    //End delusermanagerdep

    //deluserassigndept
    $('.deluserassigndept').click(function (e) {
        if (confirm(message_confirm_del)) {
            var id = $(this).data('id');
            $.ajax({
                url: base_url_admin + '/department/deluserassigndept',
                type: 'POST',
                data: {'id': id},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
    });
    //End deluserassigndept



    //checklist-type
    $('.checklist-type').click(function (e) {
        if ($(this).is(':checked') && $(this).val() == 'dw') {
            $('.dw').css('display', 'block');
        } else {
            $('.dw').css('display', 'none');
        }
    });
    //End checklist-type

    //checklist-category-add-quick
    $('.checklist-category-add-quick').click(function (e) {
        var id = $(this).data('id');
        var obj = $('#fadd' + id);
        if (obj.find('.checklist-category').val() === '') {
            alert(obj.find('.checklist-category').attr('placeholder'));
            obj.find('.checklist-category').focus();
        } else {
            $.ajax({
                url: base_url_admin + '/checklist/insertcate',
                type: 'POST',
                ///data: {'department_id': obj.find('.department-id').val(), 'checklist_category': obj.find('.checklist-category').val() },
                data: obj.serialize(),
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
        return false;
    });
    //End checklist-category-add-quick

    //btn-send-message
    $('.btn-send-message').click(function (e) {

        if ($('.title-message').val() == '') {
            alert($('.title-message').attr('placeholder'));
            $('.title-message').focus();
            return false;
        } else if ($('.textarea-message').val() == '') {
            alert($('.textarea-message').attr('placeholder'));
            $('.textarea-message').focus();
            return false;
        } else {
            var is_send = 0;
            $('#fsendmessage input[type="checkbox"]').each(function (index, element) {
                if ($(this).attr('checked')) {
                    is_send = 1;
                    return false;
                }
            });
            if (is_send == 0) {
                alert($(this).data('message-user-require'));
                return false;
            } else {
                var user_id = Array();
                $('#fsendmessage input[type="checkbox"]').each(function (index, element) {
                    if ($(this).attr('checked')) {
                        user_id.push($(this).val());
                    }
                });
                $('#user_id').val(user_id.toString());
                setTimeout(function () {

                }, 300);
            }
        }
        /*else {
         $('input:checkbox:checked').each(function(){
         alert($(this).val())
         //$(this).doSomething();//this is the checked checkbox
         });
         }*/
    });
    //End btn-send-message

    //arrangement-table-open-popopu
    $('.arrangement-table-open-popopu').click(function (e) {

        var obj = $(this);

        $.ajax({
            url: base_url_admin + '/arrangementtable/get-dept-of-manager.html',
            type: 'GET',
            data: {'managerid': obj.data('managerid')},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                var str = '';
                $('.arrangement-table-icon-check li').css('display', 'none');
                $.each(results.data, function (i, item) {
                    $('.id-dept-' + item.department_id).css('display', 'block');
                    //alert(item.department_id + '==' + item.department_name );
                    ///str += biullHtmlDept(item.department_id, item.department_name);
                });
                ///$('.arrangement-table-icon-check').html(str);
            }
        });
        setTimeout(function () {}, 300);

        $('#modalForward').on('shown.bs.modal', function () {

            $('.arrangement-table-icon-check label').removeClass('active');
            ///$('.arrangement-table-icon-check input').attr('checked', false);

            var avail = obj.data('avail');
            if (avail === 1) {
                $('#avail').attr('checked', true);
                $('#avail').prop('checked');
                $('label[for="avail"]').addClass('active');
            } else {
                $('#avail').attr('checked', false);
                $('label[for="avail"]').removeClass('active');
            }
            var id = obj.data('id');
            $('.farrangement-table #id').val(id);

            var departmentid = obj.data('departmentid');
            $('#cb' + departmentid).attr('checked', true);
            ///$('#cb' + departmentid).prop('checked');

            $('label[for="cb' + departmentid + '"]').addClass('active');
            ///window.setTimeout(function(){
            $('.manager-name').html(obj.data('managername'));
            $('.department-name-from').html(obj.data('departmentname'));
            $('.department-name-to').html(obj.data('departmentname'));
            $('.staff-name').html(obj.text());
            ///}, 0500);
        })

    });
    //End arrangement-table-open-popopu

    //delete-banner
    $('.delete-banner').click(function (e) {
        if (confirm($(this).data('message'))) {
            var id = $(this).data('id'),
                    fileCurent = $(this).data('filecurent');
            $.ajax({
                url: base_url_admin + '/banner/del',
                type: 'POST',
                data: {'id': id, 'fileCurent': fileCurent},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
    });
    //End delete-banner


    //on page checklist-create.html
    //checklist_department_id
    $('#checklist_department_id').change(function (e) {
        var department_id = $(this).find('option:selected').val();
        $.ajax({
            url: base_url_admin + '/checklist/getusermanager',
            type: 'GET',
            data: {'department_id': department_id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                $('#checklist_manager_id').html(results.data);
            }
        });
    });
    //End checklist_department_id

    //on page department/add-user-manager-dep.tpl
    //fusermanagerdept
    $('#fusermanagerdept #department_id').change(function (e) {
        var department_id = $(this).find('option:selected').val();
        $.ajax({
            url: base_url_admin + '/department/getusermanager',
            type: 'GET',
            data: {'department_id': department_id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                $('#fusermanagerdept #user_id_manager').html(results.data);
            }
        });
    });
    //End fusermanagerdept

    //on page department/add-user-assign-dept.tpl
    //department_id
    $('#fdepartment_userassigndept #department_id').change(function (e) {
        var department_id = $(this).find('option:selected').val();
        $.ajax({
            url: base_url_admin + '/department/getmanager',
            type: 'GET',
            data: {'department_id': department_id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                var str = '<option value=""></option>';
                $.each(results.data, function (i, item) {
                    str += '<option value="' + item.user_id + '">' + item.user_fullname + '</option>';
                });
                $('#fdepartment_userassigndept #manager_id').html(str);
            }
        });
    });
    //End department_id

    //on page department/add-user-assign-dept.tpl
    //department_id
    $('#fdepartment_userassigndept #manager_id').change(function (e) {
        var manager_id = $(this).find('option:selected').val();
        $.ajax({
            url: base_url_admin + '/department/getstaff',
            type: 'GET',
            data: {'manager_id': manager_id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                var str = '';
                $('#fdepartment_userassigndept #user_id_staff').html(results.data);
            }
        });
    });
    //End manager_id

    $('input[name="datecomment"]').datepicker({
        dateFormat: "yy/mm/dd",
        onSelect: function (dateText) {
            $('#fcomments').submit();
            ///display("Selected date: " + dateText + "; input's current value: " + this.value);
        }
    });

    //fcomments
    $('#fcomments select').change(function (e) {
        $('#fcomments').submit();
    });
    //End fcomments

    $('input[name="finddate"]').datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (dateText) {
            $('#fchecklistresults').submit();
            ///display("Selected date: " + dateText + "; input's current value: " + this.value);
        }
    });

    //delete-checklist-of-staff
    $('.delete-checklist-of-staff').click(function (e) {
        if (confirm($(this).data('message'))) {
            var id = $(this).data('id');
            $.ajax({
                url: base_url_admin + '/checklist/delchecklistofstaff',
                type: 'POST',
                data: {'id': id},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
    });
    //End delete-checklist-of-staff

    //delete-checklist-of-manager
    $('.delete-checklist-of-manager').click(function (e) {
        if (confirm($(this).data('message'))) {
            var id = $(this).data('id');
            $.ajax({
                url: base_url_admin + '/checklist/delchecklist',
                type: 'POST',
                data: {'id': id},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
    });
    //End delete-checklist-of-manager

    //parent_category_id
    $('#parent_category_id').change(function (e) {
        var departmentid = $(this).find('option:selected').data('departmentid');

        $.ajax({
            url: base_url_admin + '/checklist/getdepartment',
            type: 'GET',
            data: {'departmentid': departmentid},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                $('#checklist_department_id').html(results.data);
            }
        });

        $.ajax({
            url: base_url_admin + '/checklist/getusermanager',
            type: 'GET',
            data: {'department_id': departmentid},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                $('#checklist_manager_id').html(results.data);
            }
        });



    });
    //End parent_category_id
    
    //delhospital
    $('.delhospital').click(function (e) {
        if (confirm($(this).data('message'))) {
            var id = $(this).data('id');
            $.ajax({
                url: base_url_admin + '/hospital/del',
                type: 'GET',
                data: {'id': id},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {
                    document.location.reload(true);
                }
            });
        }
    });
    //End delhospital
    
    //delhospital select2
    $("#freportchecklist #hospital_id").select2({
        //templateSelection: getDepAjx
    }).on("change", function (e) {
        getDepAjx(this.value, '');
         // var str = $("#s2id_search_code .select2-choice span").text();
         // DOSelectAjaxProd(e.val, str);
    });
    
    $("#fchecklistresults #hospital_id").select2({
        //templateSelection: getDepAjx
    }).on("change", function (e) {
        getDepAjx(this.value, '<option value="">---</option>');
    });
    
    $("#fnewchecklistresults #department_id").select2({
        //templateSelection: getDepAjx
    }).on("change", function (e) {
        getUserAjx(this.value, '<option value="">---</option>');
    });
    
    
    
    $("#freportchecklist #department_id").select2();
    $("#freportchecklist #year").select2();
    $("#freportchecklist #month").select2();
    $("#fchecklistresults #department_id").select2();
    $("#fchecklistresults #year").select2();
    $("#fchecklistresults #month").select2();
    $("#fchecklistresults #day").select2();
    
    
    $("#fnewchecklistresults #department_id").select2();
    $("#fnewchecklistresults #year").select2();
    $("#fnewchecklistresults #month").select2();
    //$("#fnewchecklistresults #day").select2();
    $("#fnewchecklistresults #staffid").select2();
    
    $("#fnewchecklistresults #staff_id").select2();
    
    
    //get default
    var vhospital_id = $("#freportchecklist #hospital_id option:selected").val();
    ///getDepAjx(vhospital_id);
    /*
    $('#ffinddept').submit(function(){
        var iddept = $('.list-inline.list-team .active .find-dept').data("iddept");
        $(this).find('#dept').val(iddept);
        setTimeout(function(){
            
        },200);
    });
    */
    /*
    $('.find-dept').click(function(){
        var iddept = $(this).data("iddept");
        $('#ffinddept').find('#dept').val(iddept);
        $('#ffinddept').submit();
        return false;
    });
    */
   
   $("#fnewchecklistresults").submit(function(){
       
        if( $("#fnewchecklistresults #month option:selected").val() == '' ){
            alert($("#fnewchecklistresults").data('required_day_month_year'));
            return false;
        }
        ///if( $("#fnewchecklistresults #staff_id option:selected").val() == '' ){
        ///    alert($("#fnewchecklistresults").data('requiredstaff'));
        //    return false;
        //}
        
        var v = $('#fnewchecklistresults #day option:selected').val();
        var vhospital_id = $("#fnewchecklistresults #hospital_id option:selected").val();
        if( v == '' && vhospital_id == ''){
            alert($('#fnewchecklistresults').data('requireddayorhospital'));
            return false;
        }
        
    });
    
    $("#fchecklistresults").submit(function(){
        var v = $('#fchecklistresults #day option:selected').val();
        var vhospital_id = $("#fchecklistresults #hospital_id option:selected").val();
        if( v == '' && vhospital_id == ''){
            alert($('#fchecklistresults').data('requireddayorhospital'));
            return false;
        }        
    });
    
    
    
   $('#fdata #hospital_id').change(function(){
       var hospital_id = $(this).val();
       $('#checklist_manager_id option').empty();
       $.ajax({
            url: base_url_admin + '/checklist/getdept',
            type: 'GET',
            data: {'hospital_id': hospital_id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                $('#checklist_department_id').html(results.data);
            }
        });
   });
   
   $("#fnewchecklistresults #hospital_id").select2({
        //templateSelection: getDepAjx
    }).on("change", function (e) {
        getDepAjx(this.value, '<option value="">---</option>');
    });
    
    $('input[name="date_add"]').datepicker({
        dateFormat: "yy/mm/dd",
        onSelect: function (dateText) {
            ///display("Selected date: " + dateText + "; input's current value: " + this.value);
        }
    });
    
    $('input[name="data[date_add]"]').datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function (dateText) {
            ///display("Selected date: " + dateText + "; input's current value: " + this.value);
        }
    });
    
    $('#fupdatechecklistresults').submit(function(){
       var valArr = [];
        $("#fupdatechecklistresults label.icon-check").each(function() {
            if($(this).hasClass('active')){
                var f = $(this).attr('for');
                valArr.push($('#'+f).val());
            }                
        });
        $('#fupdatechecklistresults #submit_checklist_id').val(valArr.toString());
        setTimeout(function(){
            var href = document.location.href;
            $.post(href, $('#fupdatechecklistresults').serialize(), function(data) {
                if( data.trim() == "no_replace"){
                    document.location.reload(true);
                }
                else{
                    var shref = href.replace("submitid=0", "submitid="+data);
                    document.location.href = shref;//.reload(true);
                }
            });
        }, 200);
        return false;
    });
    
    $('.emoticon').click(function(){
        $('.emoticon').removeClass('selectd');
        $(this).addClass('selectd');
        $('#emoticon').val($(this).data('val'));
    });
    
    //rstrash
    $('.rstrash').click(function(){
        if (confirm(message_confirm_del)) {
            var user_id = $(this).data('user_id');
            var submit_id = $(this).data('submit_id');
            //var checklist_id = $(this).data('checklist_id');
            $.ajax({
                url: base_url_admin + '/checklistresults/delete',
                type: 'GET',
                data: {'userid': user_id, 'submitid': submit_id},
                //this is the dataType    
                dataType: 'json',
                success: function (results) {                    
                    document.location.reload( true );
                }
            });
        }
    });
    
   
});

function update(obj, e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        var id = $(obj).attr('id');
        var value = $(obj).val();
        $('.lab-' + id).css({'display': 'block'}).text(value);
        $('#' + id).css({'display': 'none'});

        $.ajax({
            url: base_url_admin + '/setup/update',
            type: 'POST',
            data: {'value': value, 'obj': id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                ///document.location.reload( true );
            }
        });

    }

}

function updateDepartment(obj, e) {
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        var id = $(obj).attr('id');
        var value = $(obj).val();
        $('.lab-' + id).css({'display': 'block'}).text(value);
        $('#' + id).css({'display': 'none'});
        var objs = $('#hospital_id' + id +" option:selected");
        var hospital_id = objs.val();
        $('.labh-' + id).css({'display': 'block'}).text(objs.text());
        $('#hospital_id' + id).css({'display': 'none'});
        
        $.ajax({
            url: base_url_admin + '/department/update',
            type: 'POST',
            data: {'department_name': value, 'department_id': id, 'hospital_id': hospital_id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                ///document.location.reload( true );
            }
        });
    }
}

function updateDepartmentH(obj, e) {
    
    var id = $(obj).attr('id').replace("hospital_id", "");
    var value = $('#' + id).val();
    $('.lab-' + id).css({'display': 'block'}).text(value);
    $('#' + id).css({'display': 'none'});
    var objs = $('#hospital_id' + id +" option:selected");
    var hospital_id = objs.val();
    $('.labh-' + id).css({'display': 'block'}).text(objs.text());
    $('#hospital_id' + id).css({'display': 'none'});

    $.ajax({
        url: base_url_admin + '/department/update',
        type: 'POST',
        data: {'department_name': value, 'department_id': id, 'hospital_id': hospital_id},
        //this is the dataType    
        dataType: 'json',
        success: function (results) {
            ///document.location.reload( true );
        }
    });
}

function sub_categories_add_more() {
    var more = $('.step-2 .form-group').length + 1;
    var html = html_of_ub_categories_add_more(more);
    $('.step-2').append(html);
}

function sub_categories_del_more(obj) {
    $(obj).parent().parent('.form-group').remove();
}

function html_of_ub_categories_add_more(more) {
    var str = '';
    str = '<div class="form-group more' + more + '">\
			<label class="col-sm-4 control-label">&nbsp;</label>\
			<div class="col-sm-4">\
				<input type="text" name="data[checklist_sub_categories][]" class="form-control" >\
			</div>\
			<div class="col-sm-4">\
				<a onClick="sub_categories_del_more(this);" href="javascript:void(0);" class="sub-categories-add-more" title="delete">\
					<img src="' + base_tlp_admin + '/img/icon/icon-delete.png">\
				</a>\
			</div>\
		</div>';
    return str;
}

function insert(obj, e) {
    //checklist insert
    var keycode = (e.keyCode ? e.keyCode : e.which);
    if (keycode == '13') {
        var category_id = $(obj).data('category_id');
        var parent_category_id = $(obj).data('parent_category_id');
        var title = $(obj).val();
        $.ajax({
            url: base_url_admin + '/checklist/insert',
            type: 'POST',
            data: {'title': title, 'checklist_category_id': category_id, 'parent_category_id': parent_category_id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                /*$(obj).val('');
                 var str = '<li class="load-auto">\
                 <i class="icon-delete" onclick="deletes(this, ' + results.checklist_id + ');"></i>\
                 <label>' + title + '</label>\
                 </li>';
                 
                 if( $('.list-unstyled' + category_id).children('.load-auto').length == 0 ){
                 ///$(str).insertBefore('.list-unstyled' + category_id + " li");
                 $('.list-unstyled' + category_id).prepend(str); //the use prepend len tren cung
                 }
                 else {
                 $('.list-unstyled' + category_id + " .load-auto").append(str);//the use prepend len tren cung
                 }*/
                document.location.reload(true);
            }
        });
    }
    //End checklist insert
}

function deletes(obj, checklist_id) {
    if (confirm(message_confirm_del)) {
        $.ajax({
            url: base_url_admin + '/checklist/delete',
            type: 'GET',
            data: {'checklist_id': checklist_id},
            dataType: 'json',
            success: function (results) {
                $(obj).parent().remove();
            }
        });
    }
}

function biullHtmlDept(department_id, department_name) {
    var str = '<li class="hvr-underline-from-left id-dept-' + department_id + '">\
				<input type="radio" name="position" id="cb' + department_id + '" value="' + department_id + '" />\
				<label class="icon-check" for="cb' + department_id + '">\
					<span class="text-danger f-mont f-18">' + department_name + '</span>\
				</label>\
			</li>';
    return str;
}

//deleteMessage
function deleteMessage(obj, id, message) {
    if (confirm(message)) {
        $.ajax({
            url: base_url_admin + '/home/deleteMessage',
            type: 'POST',
            data: {'id': id},
            //this is the dataType    
            dataType: 'json',
            success: function (results) {
                document.location.reload(true);
            }
        });
    }

}
//End deleteMessage

//getDepAjx
function getDepAjx( id, optionMore ){
    $.ajax({
        url: base_url_admin + '/get-department-ajx.html',
        type: 'GET',
        data: {'hospital_id': id},
        //this is the dataType    
        dataType: 'json',
        success: function (results) {
            $('#department_id').html( optionMore + results.data)
        }
    });
}

//getDepAjx
function getUserAjx( id, optionMore ){
    $.ajax({
        url: base_url_admin + '/get-user-ajax.html',
        type: 'GET',
        data: {'department_id': id},
        //this is the dataType    
        dataType: 'json',
        success: function (results) {
            $('#staff_id').html( optionMore + results.data)
        }
    });
}
