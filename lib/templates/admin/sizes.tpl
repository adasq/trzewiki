<div class="page-header">
  <h1>Rozmiary <small>Zarządzaj rozmiarami butów!</small></h1>
</div>

<div class="panel panel-default">
  <div class="panel-body">
  <form  method="GET" action="{#BASE_URL#}/admin/sizes/new">
	 	<button type="submit" class="btn btn-success">Dodaj nowy</button>
</form> 
  </div>
</div>


{if isset($sizes)}<div class="panel panel-default">


  <div class="panel-heading">Rozmiary </div>
  <div class="panel-body">
    
<!-- <form method="GET" class="filter_form" action="">


	<button type="submit" onclick="test()"  class="btn btn-success">Wybierz</button>
</form> -->


<form method="GET" class=" filter_form form-inline" role="form">
  <div class="form-group">
    <label class="sr-only" for="exampleInputEmail2">Email address</label>

<select class="form-control">
  {foreach $manufacturers as $manufacturer} 
    <option  

{if isset($smarty.get.manu) &&  $smarty.get.manu eq $manufacturer->manufacturer_id}  selected    	{/if}

    	value="{$manufacturer->manufacturer_id}"> {$manufacturer->name}</option>
  {/foreach}
</select>
  </div>
  	<button type="submit" onclick="test()"  class="btn btn-success">Wybierz</button>

</form>

<div class="row">
	&nbsp
</div>


	
<!-- size_id
manufacturer_id
us
uk
cm
euro
sex
deleted -->
 


<div class="row">

{if $currentManufacturer}
<div class="col-sm-6">

<div class="panel panel-default">
  <div class="panel-heading">Mężczyźni</div>
  <div class="panel-body">
 
<table class="table table-striped">
<tr> <td>us</td> <td>uk</td> <td>cm</td> <td>euro</td> 		<td></td>  	</tr>
{foreach $sizes as $size} 
{if $currentManufacturer->manufacturer_id eq $size->manufacturer_id && 
	"male" eq $size->sex} 

	<tr>  <td>{$size->us}</td> <td>{$size->uk}</td> <td>{$size->cm}</td> <td>{$size->euro}</td>

	<td>
<div class="btn-group">
	<form style="float: left;" method="GET" action="{#BASE_URL#}/admin/sizes/edit/{$size->size_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>


</div></td></tr>
 {/if}  
{/foreach}
</table>
  </div>
</div>
</div>




<div class="col-sm-6">

<div class="panel panel-default">
  <div class="panel-heading">Kobiety</div>
  <div class="panel-body">
 
<table class="table table-striped">
<tr> <td>us</td> <td>uk</td> <td>cm</td> <td>euro</td> 		<td></td>  	</tr>
{foreach $sizes as $size} 
{if $currentManufacturer->manufacturer_id eq $size->manufacturer_id && 
	"female" eq $size->sex} 

	<tr>  <td>{$size->us}</td> <td>{$size->uk}</td> <td>{$size->cm}</td> <td>{$size->euro}</td>

	<td>
<div class="btn-group">
	<form style="float: left;" method="GET" action="{#BASE_URL#}/admin/sizes/edit/{$size->size_id}">
		<button type="submit" class="btn btn-default">Edycja</button>
	</form>
</div></td></tr>
 {/if}  
{/foreach}
</table>
  </div>
</div>
</div>





{else}



 {/if}  







  </div><!-- row -->
</div><!-- panel body -->



 </div> {/if}<!-- sizes -->




<script>
function test(){
	$('.filter_form').attr("action", "http://localhost/trzewiki/admin/sizes/manufacturer/"+$('.filter_form select').val());
}
</script>