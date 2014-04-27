<?php /* Smarty version Smarty-3.1.12, created on 2014-04-27 13:19:20
         compiled from "..\lib\templates\main_template.tpl" */ ?>
<?php /*%%SmartyHeaderCode:31525535ce6ce2d2dc1-89133520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '48718cf6295605b34579f498f3985727021c4b97' => 
    array (
      0 => '..\\lib\\templates\\main_template.tpl',
      1 => 1398597558,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31525535ce6ce2d2dc1-89133520',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_535ce6ce301bd6_91247408',
  'variables' => 
  array (
    'PAGE_TITLE' => 0,
    'CONTENT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535ce6ce301bd6_91247408')) {function content_535ce6ce301bd6_91247408($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">


<html xmlns="http://www.w3.org/1999/xhtml"  xml:lang="en" lang="en"> 

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $_smarty_tpl->tpl_vars['PAGE_TITLE']->value;?>
 | trzewiki</title> 

 <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.min.js"></script> 
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
 
  <link type='text/css' rel="stylesheet" href="<?php echo $_smarty_tpl->getConfigVariable('BASE_URL');?>
/public_files/css/main.css" />
	  <script type="text/javascript" src="<?php echo $_smarty_tpl->getConfigVariable('BASE_URL');?>
/public_files/js/main.js"></script>



</head>


<body>
<div class="container">
<?php echo $_smarty_tpl->getSubTemplate ("main_nav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<div class="row">
  <div class="col-md-2"> 
  	lewoooo
  </div>
  <div class="col-md-10">

 <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['CONTENT']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>


  </div>
</div>


</div>


 <div id="footer">
      <div class="container">
footer
      </div>
    </div>



</body>
</html>





<?php }} ?>