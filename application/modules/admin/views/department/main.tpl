            <section class="content p-t-30">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.add_department}</h4>
                    <div class="group-btn">
                        <a class="hoverJS" href="javascript:void(0);" data-toggle="modal" data-target="#modalAddlang" title="{$lable.create}">
                            <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                        </a>
                    </div>
                </div>
                <form class="form-horizontal margin-none" name="freportchecklist" id="freportchecklist" method="get" action="" enctype="multipart/form-data">
                      
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        {$lable.choose_hospital}
                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="hospital_id" id="hospital_id">
                               <option value="">---</option>
                                {if $hospitalData}
                                    {foreach from=$hospitalData item=itemH}
                                <option {if isset($smarty.get.hospital_id) && $smarty.get.hospital_id eq $itemH.hospital_id}selected{/if} value="{$itemH.hospital_id}">{$itemH.hospital_name}</option>
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2"> &nbsp; </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary"> {$lable.btn_search} </button>
                        </div>
                    </div>
                </form>
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-custom text-center department-list">
                        <tr class="text-purple text-bold f-16">
                            <th style="min-width: 100px; width: 100px;">{$lable.id}</th>
                            <th style="min-width: 150px;">{$lable.hospital}</th>
                            <th style="min-width: 150px; width: 150px;">{$lable.name}</th>
                            <th>{$lable.date_add}</th>
                            <th>{$lable.last_update}</th>
                            <th>&nbsp;</th>
                        </tr>
                        {foreach from=$list key=k item=v}
                        <tr>
                            <td >{$v->department_id}</td>
                            <td >
                                <label class="labh-{$v->department_id}">{$v->hospital_name}</label>
                                <select onchange="updateDepartmentH(this, event);" class="form-control" name="hospital_id" id="hospital_id{$v->department_id}" style="display:none">
                                    <option value="">---</option>
                                     {if $hospitalData}
                                         {foreach from=$hospitalData item=itemH}
                                     <option {if $v->hospital_id eq $itemH.hospital_id}selected{/if} value="{$itemH.hospital_id}">{$itemH.hospital_name}</option>
                                         {/foreach}
                                     {/if}
                                 </select>
                            </td>
                            <td>
                            <label class="lab-{$v->department_id}">{$v->department_name}</label>
                            <input class="form-control" onkeyup="updateDepartment(this, event);" value="{$v->department_name}" style="display:none" id="{$v->department_id}"  name="{$v->department_id}" />
                            </td>
                            <td>
                            {$v->date_add}
                            </td>
                            <td>
                            {$v->last_update}
                            </td>
                            <td style="width:90px;">                            
                            <a class="btn btn-danger department-edit" data-id="{$v->department_id}" href="javascript:void(0);" title="Edit" style="border-radius:50%; padding:4px 7px; float:left">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a style="float:right" class="hoverJS delete-dep" data-message="{$lable.confirm_del} ({$v->department_name}) of ({$v->hospital_name})?" data-id="{$v->department_id}" href="javascript:void(0);" title="{$lable.delete}">
                                <i class="fa fa-trash"></i>
                            </a>
                            </td>
                        </tr>
                        {/foreach}
                    </table>
                </div>
                <!-- /Table -->
                
                <!-- modal-Addlang -->
                <div class="modal modal-purple fade" id="modalAddlang">
                    <div class="modal-dialog modal-purple">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title text-center">{$lable.add_department}</h4>
                                <button type="button" class="close">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="modal-body-content">
                                    <form name="fAddDepartment" id="fAddDepartment" class='form-horizontal' method="post" action="{$base_url_admin}/department/add.html">
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                            {$lable.choose_hospital}
                                            <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <select class="form-control" name="hospital_id" id="hospital_id">
                                                   <option value="">---</option>
                                                    {if $hospitalData}
                                                        {foreach from=$hospitalData item=itemH}
                                                    <option value="{$itemH.hospital_id}">{$itemH.hospital_name}</option>
                                                        {/foreach}
                                                    {/if}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                            {$lable.name}
                                            <span class="required">*</span>
                                            </label>
                                            <div class="col-md-9">
                                                <input id="name" name="name" class="form-control" />
                                            </div>
                                        </div>
                                        
                                        <hr class="row clearfix m-lr-25"></hr>
                                        <div class="row">
                                            <div class="col-xs-6">
                                            </div>
                                            <div class="col-xs-6">
                                                <button type="submit" class="btn bg-danger btn-custom btn-block">{$lable.btn_save}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Modal-addlang -->
            </section>
