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
    <label>login</label>
    <input  value="{$customer->login}" name="login" type="text" class="form-control" placeholder="login">
  </div>

  <div class="form-group">
    <label>Password</label>
    <input value="{$customer->password}" name="password"  type="password" class="form-control" placeholder="Password">
  </div>
  <div class="form-group">
    <label>email</label>
    <input value="{$customer->email}" name="email"  type="text" class="form-control" placeholder="email">
  </div>

  <div class="form-group">
    <label>first_name</label>
    <input value="{$customer->first_name}" name="first_name"  type="text" class="form-control" placeholder="first_name">
  </div>
  <div class="form-group">
    <label>last_name</label>
    <input value="{$customer->last_name}" name="last_name"  type="text" class="form-control" placeholder="last_name">
  </div>
    <div class="form-group">
    <label>street</label>
    <input value="{$customer->street}" name="street"  type="text" class="form-control" placeholder="street">
  </div>

    <div class="form-group">
    <label>street_additional</label>
    <input value="{$customer->street_additional}" name="street_additional"  type="text" class="form-control" placeholder="street_additional">
  </div>

    <div class="form-group">
    <label>zip_code</label>
    <input value="{$customer->zip_code}" name="zip_code"  type="text" class="form-control" placeholder="zip_code">
  </div>


      <div class="form-group">
    <label>city</label>
    <input value="{$customer->city}" name="city"  type="text" class="form-control" placeholder="city">
  </div>

      <div class="form-group">
    <label>status</label>
    <input value="{$customer->status}" name="status"  type="text" class="form-control" placeholder="status">
  </div>


  <div class="checkbox">
    <label>
      <input checked type="checkbox"> Deleted
    </label>
  </div>

  <button type="submit" class="btn pull-right btn-success">Zapisz</button>
</form>



  </div>
</div></div>


{/if}