<?php /* Smarty version Smarty-3.1.12, created on 2014-04-27 13:27:52
         compiled from "..\lib\templates\main_nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:25850535ce6ce320fd3-93343177%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95b695239341d335a87ac5461571e10833c987c1' => 
    array (
      0 => '..\\lib\\templates\\main_nav.tpl',
      1 => 1398598071,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25850535ce6ce320fd3-93343177',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_535ce6ce328cd8_17140356',
  'variables' => 
  array (
    'user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_535ce6ce328cd8_17140356')) {function content_535ce6ce328cd8_17140356($_smarty_tpl) {?> 
 <?php if (isset($_smarty_tpl->tpl_vars['user']->value)){?>




<?php }else{ ?>


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $_smarty_tpl->getConfigVariable('BASE_URL');?>
/home">Sklep internetowy</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo $_smarty_tpl->getConfigVariable('BASE_URL');?>
/about">O nas</a></li>
        <li><a href="<?php echo $_smarty_tpl->getConfigVariable('BASE_URL');?>
/buy">Kup</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Więcej <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
     
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Jan Kowalski <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Opcje</a></li>
            <li class="divider"></li>
            <li><a href="#">Wyloguj</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>












<?php }?>













<?php }} ?>