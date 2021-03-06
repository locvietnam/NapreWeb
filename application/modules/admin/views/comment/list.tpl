			<section class="content-header">
            	<form action="" method="get" name="fcomments" id="fcomments">
                <div class="col-md-3">
                	<label class="col-sm-4 control-label text-right">
                    {$lable.choose_hospital}
                    </label>
                    <div class="col-sm-8">
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
                <div class="col-md-3">
                	<input class="form-control" placeholder="Select Datetime" name="datecomment" value="{$datecomment}" />
                	<input type="hidden" id="strtime" value="{$strtime}" />
                </div>
                <div class="col-md-3">
                	<select name="dept" id="dept" class="form-control">
                    	<option value=""> --- {$lable.select_department} --- </option>
                        {foreach from=$listDept item=item}
                        	<option {if isset($smarty.get.dept) && $smarty.get.dept eq $item->department_id}selected{/if} value="{$item->department_id}">{$item->department_name}</option>
                        {/foreach}
                    </select>
                    <input type="submit" style="display:none;" value="search">
                </div>
                </form>
            </section>

            <section class="content">
            	{foreach from=$list item=item}
                <!-- box -->
                <div class="box box-solid">
                    <div class="box-header">
                        <h4 class="box-title">{$item.user_fullname}</h4>
                    </div>
                    <div class="box-body">
                        <p class="time text-success">{$item.fadd_date}</p>
                        <p>{$item.comments}</p>
                    </div>
                </div>
                <!-- /box -->
				{/foreach}

            </section>