            <section class="content-header">
                
                <form class="form-horizontal margin-none" name="freportchecklist" id="freportchecklist" method="get" action="" enctype="multipart/form-data">
                      
                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        {$lable.choose_hospital}
                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="hospital_id" id="hospital_id">
                               <option>---</option>
                                {if $hospitalData}
                                    {foreach from=$hospitalData item=itemH}
                                <option {if isset($smarty.get.hospital_id) && $smarty.get.hospital_id eq $itemH.hospital_id}selected{/if} value="{$itemH.hospital_id}">{$itemH.hospital_name}</option>
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        {$lable.choose_department}
                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="department_id" id="department_id">
                                {if $departmentData}
                                    {foreach from=$departmentData item=itemD}
                                <option {if isset($smarty.get.department_id) && $smarty.get.department_id eq $itemD->department_id}selected{/if} value="{$itemD->department_id}">{$itemD->department_name}</option>
                                    {/foreach}
                                {/if}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">
                        {$lable.year_month}
                        </label>
                        <div class="col-sm-4">
                            <select class="form-control" name="year" id="year">
                            {$yearData}
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <select class="form-control" name="month" id="month">
                            {$monthData}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-2"> &nbsp; </div>
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary"> {$lable.btn_view} </button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="content">
                <div class="table-responsive">
                    <table class="table table-bordered table-custom text-center text-bold" style="width: 99%;">
                        <tr class="text-purple f-16">
                            <th style="min-width: 20%; width: 20%;">{$lable.reportchecklist_day_of_month}
							</th>
                            <th style="min-width: 20%; width: 20%;">{$lable.reportchecklist_percent_completion}(%)
							</th>
                            <th style="min-width: 60%; width: 60%;">{$lable.reportchecklist_icon}</th>
                        </tr>                        
                        {if $list}
                        	{foreach from=$list item=item}
                        <tr>
                            <td class="text-danger f-mont f-16">{$item->fdate_add} </td>
                            <td>{$item->percent}</td>
                            <td>
                                <div class="row">
                                	{foreach from=$item->users item=itemSub}
                                    <div class="item-user col-lg-3 col-md-3 col-xs-4 col-4">                           
                                        {if $itemSub.emotion_icon eq 1 }
                                                <img  src="{$base_tlp_admin}/img/icon/mat-1-xanh.png" alt="{$itemSub.user_fullname}">
                                            
                                        {else if $itemSub.emotion_icon eq 2}
                                                <img src="{$base_tlp_admin}/img/icon/mat-2-xanh.png" alt="{$itemSub.user_fullname}">
                                                                                    
                                        {else if $itemSub.emotion_icon eq 3}
                                                <img src="{$base_tlp_admin}/img/icon/mat-3-xanh.png" alt="{$itemSub.user_fullname}">
                                        {/if}
                                    </div>
                                    {/foreach}                            		
                                </div>
                            </td>
                        </tr>
                        {/foreach}
                        {/if}
						<tr>
							<td>
								{$lable.total_percent}
							</td>
							<td>
								{$sum_percent}(%)
							</td>
							<td></td>
						</tr>                        
                    </table>
                </div>
                <form class="form-horizontal margin-none" name="freportchecklist" id="fexportreportchecklist" method="post" action="{$base_url_admin}/export-pdf.html" >
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="font-weight:bold;">
                        {$lable.report_comment}
                        </label>
                        <div class="col-sm-4">
                            <textarea class="form-control" name="report_comment" id="report_comment"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" style="font-weight:bold;">
                        {$lable.staff_report}
                        </label>
                        <div class="col-sm-4">
                            <input class="form-control" name="staff_report" id="staff_report"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-2"> &nbsp; </div>
                        <div class="col-xs-4">
                          <input name="hospital_id" type="hidden" value="{if isset($smarty.get.hospital_id)}{$smarty.get.hospital_id}{/if}">
                          <input name="department_id" type="hidden" value="{if isset($smarty.get.department_id)}{$smarty.get.department_id}{/if}">
                          <input name="year" type="hidden" value="{if isset($smarty.get.year)}{$smarty.get.year}{/if}">
                          <input name="month" type="hidden" value="{if isset($smarty.get.month)}{$smarty.get.month}{/if}">                          
                           {if $list}
                            <button type="submit" class="btn btn-primary"> {$lable.btn_exportPDF} </button>
                            {/if}
                        </div>
                    </div>
                </form>
            </section>