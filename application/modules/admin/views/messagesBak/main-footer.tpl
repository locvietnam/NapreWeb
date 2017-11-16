        <div class="main-footer">
            <div class="content-footer">
            	<div class="form-group" style="overflow:hidden;">
                    <div class="col-xs-12">
                        <input class="form-custom form-control title-message" name="title" placeholder="​{$lable.send_message_subject}" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-xs-12">
                        <textarea class="form-custom form-control textarea-message" name="message" placeholder="​{$lable.textarea_message}" rows="3"></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-10 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 col-xs-offset-1">
                        <button data-message-user-require="{$lable.message_choose_user_send_require}" type="submit" class="btn btn-danger btn-block btn-custom btn-send-message">​{$lable.btn_send}</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
