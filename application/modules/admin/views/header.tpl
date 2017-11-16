<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>{$lable.admin_cpanel_title}</title>

    <!-- Load Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700,900|Open+Sans:300,400,600,700" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{$base_tlp_admin}/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="{$base_tlp_admin}/css/bootstrap.min.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" media="all" href="{$base_tlp_admin}/css/daterangepicker.css" />-->
    <link rel="stylesheet" href="{$base_tlp_admin}/js/ui/1.12.1/themes/smoothness/jquery-ui.css">
	
	<link href="{$base_tlp_admin}/css/select2.min.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="{$base_tlp_admin}/css/main.css" rel="stylesheet">
    <link href="{$base_tlp_admin}/css/custom.css" rel="stylesheet">
    <link href="{$base_tlp_admin}/css/update.css" rel="stylesheet">
    <link href="{$base_tlp_admin}/css/skins/default.css" rel="stylesheet">
    <link href="{$base_tlp_admin}/css/lchung.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
		var base_url = "{$base_url}";
		var base_url_admin = "{$base_url_admin}"; 
		var base_tlp_admin = "{$base_tlp_admin}"; 
		var current_control = "{$current_control}";
		var current_method  = "{$current_method}";
		
		var require_input_field	= "{$lable.require_input_field|stripslashes}";
		var message_confirm_del = "{$lable.confirm_del}";
	
    </script>
</head>

<body class="skin-default sidebar-mini">