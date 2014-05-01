 
{if isset($authorized)}

{else}

{/if}
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
      <a class="navbar-brand" href="{#BASE_URL#}/admin">Panel administracyjny</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <ul class="nav navbar-nav">
       <li><a href="{#BASE_URL#}/admin/login"> <span class="glyphicon glyphicon-shopping-cart" ></span> Sklepu</a></li>
      <!--  <li ><a href="{#BASE_URL#}/admin/logout">Logout</a></li>
        <li ><a href="{#BASE_URL#}/about">O nas</a></li>
        <li><a href="{#BASE_URL#}/buy">Kup</a></li> -->
<!--         <li class="dropdown">
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
        </li> -->
      </ul>

      <ul class="nav navbar-nav navbar-right">
     
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span> {$authorized->first_name} {$authorized->last_name} 
          <b class="caret"></b></a>

          <ul class="dropdown-menu">
           <!--  <li><a href="#">Opcje</a></li> {$authorized->admin_id} -->
            <li><a href="{#BASE_URL#}"><span class="glyphicon glyphicon-cog"></span> Profil</a></li>
            <li class="divider"></li>
            <li><a href="{#BASE_URL#}/admin/logout"><span class="glyphicon glyphicon-off"></span> Wyloguj się</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


























