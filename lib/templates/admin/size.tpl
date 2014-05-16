{if isset($alert)}
<div class="alert alert-{$alert->type} alert-dismissable">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
{$alert->text}
</div>
{/if}


{if isset($size)}

 <div class="col-md-10 col-md-offset-1">

<div class="panel panel-default">
  <div class="panel-heading">Edytuj dane </div>
  <div class="panel-body">


<form role="form" class="form" action="" method="POST">
<input type="hidden" name="size_id" value="{$size->size_id}">
  
 
  <div class="form-group">
    <label>Producent:</label>
<select class="form-control"  value="{$size->manufacturer_id}" name="manufacturer_id" >
  {foreach $manufacturers as $manufacturer} 
    <option  {if $manufacturer->manufacturer_id eq $size->manufacturer_id} selected {/if}    value="{$manufacturer->manufacturer_id}">{$manufacturer->name}</option>
  {/foreach}
</select>
  </div>

    <div class="form-group">
    <label>us</label>
    <input  value="{$size->us}" name="us" type="text" class="form-control" placeholder="us">
  </div>
    <div class="form-group">
    <label>uk</label>
    <input  value="{$size->uk}" name="uk" type="text" class="form-control" placeholder="uk">
  </div>
    <div class="form-group">
    <label>cm</label>
    <input  value="{$size->cm}" name="cm" type="text" class="form-control" placeholder="cm">
  </div>
    <div class="form-group">
    <label>euro</label>
    <input  value="{$size->euro}" name="euro" type="text" class="form-control" placeholder="euro">
  </div>
  	

  	 <div class="form-group">
    <label>Płeć</label>
<select class="form-control" name="sex" >
    <option  {if $size->sex eq 0} selected {/if}   value="0">Kobieta</option>
     <option  {if $size->sex eq 1} selected {/if}   value="1">Mężczyzna</option>
</select>  </div>

  <button type="submit" class="btn pull-right btn-success">Zapisz</button>
</form>



  </div>
</div></div>


{/if}