	{include file="header.tpl"}
    <div class="wrapper">
        <!-- main-header -->
        {include file="sidebar_header.tpl"}
        <!-- /main-header -->

        <!-- main-sidebar -->
        {include file="sidebar.tpl"}
        <!-- /main-sidebar -->

        <!-- main-wrapper -->
        <div class="content-wrapper">
        	
        	{include file="$content.tpl"}
            
        </div>
        <!-- /content-wrapper -->

        <!-- main-footer -->
        {include file="$current_control/main-footer.tpl"}        
        <!-- /main-footer -->
    </div>
	
    {include file='footer.tpl'}