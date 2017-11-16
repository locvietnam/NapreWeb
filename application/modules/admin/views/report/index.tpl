 			<section class="content-header text-success">
                <ul class="list-inline">
                    <li class="text-success"><span class="icon-calendar"></span> {date('Y/m/d')}</li>
                </ul>
            </section>

            <section class="content">
            	<div class="box-header p-l-0 p-r-0">
                	<h4 class="box-title text-purple">{$lable.admin_sidebar_report}</h4>
                    <div class="group-btn">
                    	{if $user_data->role_id eq 5 }<!--Chi co nhom Manager moi duoc report-->
                        <a href="{$base_url_admin}/report-detail.html">
                            <img src="{$base_tlp_admin}/img/icon/icon-add.png">
                        </a>
                        {/if}
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Table -->
                    <table class="table table-bordered table-custom text-center">
                        <tr class="text-purple f-18 text-bold">
                            <th style="min-width: 200px;">{$lable.report_report}</th>
                            <th>{$lable.report_manager}</th>
                        </tr>
                        {foreach from=$list item=item key = ks }
                        <tr class="f-16">
                            <td>
                            	<a href="{$base_url_admin}/report-detail.html?id={$item.id}">{$lable.report_report} {$item.fdate_add}</a>
                            </td>
                            <td>
                                {$item.user_fullname}
                            </td>
                        </tr>
                        {/foreach}                        
                    </table>
                    <!-- /Table -->
                </div>
                {$links}
            </section>
            