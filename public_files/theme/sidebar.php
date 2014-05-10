<?php

function renderSidebar($sex) {
    $manufacturer_rec = Manufacturer::finder()->findAll("deleted = 0");

    $lis = array();

    foreach ($manufacturer_rec as $manufacturer) {
        $product_rec = Product::finder()->findAllByManufacturerID($manufacturer->manufacturer_id);
        $lis[] = '<li><a href="" title="Wyświetl produkty marki ' . $manufacturer->name . '">' . $manufacturer->name . '<span class="badge">' . count($product_rec) . '</span></a></li>';
    }

    foreach ($lis as $li) {
        echo $li;
    }
}
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Buty męskie</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <?php
            renderSidebar('male');
            ?>
        </ul>
    </div>
</div>

<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">Buty damskie</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-pills nav-stacked">
            <?php
            renderSidebar('female');
            ?>
        </ul>
    </div>
</div>