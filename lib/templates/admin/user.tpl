{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}


{if isset($customer)}

 <div class="col-md-10 col-md-offset-1">

<div class="panel panel-default">
  <div class="panel-heading">Edytuj dane użytkownika</div>
  <div class="panel-body">


<form role="form" class="form" action="" method="POST">
<input type="hidden" name="customer_id" value="{$customer->customer_id}">
  <div class="form-group">
    <label>Login:</label>
    <input  value="{$customer->login}" name="login" type="text" class="form-control" placeholder="">
  </div>

  <div class="form-group">
    <label>Hasło:</label>
    <input value="{$customer->password}" name="password"  type="password" class="form-control" placeholder="">
  </div>
  <div class="form-group">
    <label>Adres e-mail:</label>
    <input value="{$customer->email}" name="email"  type="text" class="form-control" placeholder="">
  </div>

  <div class="form-group">
    <label>Imię:</label>
    <input value="{$customer->first_name}" name="first_name"  type="text" class="form-control" placeholder="">
  </div>
  <div class="form-group">
    <label>Nazwisko:</label>
    <input value="{$customer->last_name}" name="last_name"  type="text" class="form-control" placeholder="">
  </div>
    <div class="form-group">
    <label>Ulica</label>
    <input value="{$customer->street}" name="street"  type="text" class="form-control" placeholder="">
  </div>

    <div class="form-group">
    <label>Ulica cd.</label>
    <input value="{$customer->street_additional}" name="street_additional"  type="text" class="form-control" placeholder="">
  </div>

    <div class="form-group">
    <label>Kod pocztowy</label>
    <input value="{$customer->zip_code}" name="zip_code"  type="text" class="form-control" placeholder="">
  </div>


      <div class="form-group">
    <label>Miasto</label>
    <input value="{$customer->city}" name="city"  type="text" class="form-control" placeholder="">
  </div>

    

    <div class="form-group">
    <label>Status:</label>
<select class="form-control" name="status" >
{foreach from=$states key=k item=v}
    <option  {if $v eq $customer->status} selected {/if}    value="{$v}">{$k}</option>
  {/foreach}
</select>
  </div>


   <div class="form-group">
  <div class="checkbox">
    <label>
      <input name="deleted" {if $customer->deleted eq 1 } checked {/if} type="checkbox"> Oznacz jako usunięty
    </label>
  </div>  </div>

 
  <button type="submit" class="btn pull-right btn-success">Zapisz</button>
</form>



  </div>
</div></div>


{/if}