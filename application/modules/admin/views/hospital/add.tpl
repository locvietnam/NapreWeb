            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_hospital}</h4>
                </div>
                <div class="widget-body innerAll inner-2x">
            
                    <form class="form-horizontal margin-none" name="frm_data" id="frm_data" method="post" action="" enctype="multipart/form-data">
                        <input type="hidden" value="{$data->hospital_id}" name="data[hospital_id]" />
    
                        <div class="form-group">
                            <label class="col-sm-2 control-label"><span class="red">* </span> {$lable.hospital_name}</label>
                            <div class="col-sm-4">
                                <input type="text" name="data[hospital_name]" id="hospital_name" value="{$data->hospital_name}" class="form-control" onblur="hideFieldRequire('valid_hospital_name')"/>
                                <span class="error red">{form_error('data[hospital_name]')}</span>
                                <span class="error red">{form_error('data[hospital_name_exist]')}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-2"> &nbsp; </div>
                            <div class="col-xs-2">
                                <button type="submit" class="btn btn-primary"> {$lable.btn_save} </button>
                            </div>
                        </div>
                    </form>
    
                </div><!-- /.widget-body -->
            </section>