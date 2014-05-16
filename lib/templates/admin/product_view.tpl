
{if isset($product)}

 <div class="col-md-10 col-md-offset-1">

<div class="panel panel-default">
  <div class="panel-heading">{$product->name}</div>
  <div class="panel-body">

 {foreach $manufacturers as $manufacturer} 
  {if $manufacturer->manufacturer_id eq $product->manufacturer_id}
  {$manufacturer->name}
  {/if}   
  {/foreach}

{$product->description}
  
  </div>
</div>
</div>


{/if}