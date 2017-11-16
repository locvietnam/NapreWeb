<!-- popup-logout -->
    <div class="modal modal-purple modal-center fade" id="modalLogout">
        <div class="modal-dialog modal-xs modal-purple">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="text-center">
                        {$user_data->user_fullname} さん、お疲れ様 でした。<br>ありがとうございます！
                    </p>
                    <div class="row">
                        <div class="col-sm-8 col-xs-10 col-sm-offset-2 col-xs-offset-1">
                        	<form action="{$base_url_admin}/login/logout">
                            <button type="submit" class="btn btn-danger btn-custom btn-block">終了</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /popup-logout -->

    <!-- Library JavaScript
    ================================================== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="{$base_tlp_admin}/js/jquery-1.11.3.min.js"><\/script>')
    </script>

    <script src="{$base_tlp_admin}/js/bootstrap.min.js"></script>
    
    <script src="{$base_tlp_admin}/js/moment.js"></script>
    <!--<script src="{$base_tlp_admin}/js/daterangepicker.js"></script>-->
    <script src="{$base_tlp_admin}/js/ui/1.12.1/jquery-ui.js"></script>	
    <script src="{$base_tlp_admin}/js/select2.min.js"></script>
    
    <script src="{$base_tlp_admin}/js/main.js"></script>
    <script src="{$base_tlp_admin}/js/custom.js"></script>
    <script src="{$base_tlp_admin}/js/update.js"></script>
    <script src="{$base_tlp_admin}/js/lchung-custom.js"></script>

</body>

</html>