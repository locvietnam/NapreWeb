		{if $current_method != 'listcm'}
            {if $user_data->role_id eq 5 }
            <div class="main-footer">
                <div class="content-footer">            	
                        <input type="hidden" name="submitid" value="{if isset($smarty.get.submitid)}{$smarty.get.submitid}{/if}" />
                    <div class="row">
                        <div class="col-xs-12">
                            <textarea class="form-custom" name="textcomment" placeholder="コメント" rows="3"></textarea>
                            <span class="error red">{form_error('textcomment')}</span>
                        </div>
                    </div>
                    <div class="row">
                        <!--<div class="col-lg-3 col-md-4 col-xs-6 col-lg-offset-3 col-md-offset-2">
                            <a href="#" class="btn btn-default btn-block btn-custom">次へ</a>
                        </div>-->
                        <div class="col-lg-12 col-md-12 col-xs-12">
                            <button type="submit" class="btn btn-danger btn-block btn-custom">次へ</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            {/if}
        {else}
        {$links}
        {/if}