<?php

function renderHotProducts($limit = null) {
    $product_rec = Product::finder()->findLatestProducts($limit);

    foreach ($product_rec as $product) {
        $media_rec = Media::finder()->findByProductID($product->product_id);
        echo '  <div class="col-xs-' . (12 / $limit) . '">'
        . '         <a href="' . HOST . 'manufacturer/' . $product->manufacturer_id . '/product/' . $product->product_id . '" class="latest-product">'
        . '             <div class="panel">'
        . '                 <div class="panel-body">'
        . '                     <img src="' . IMAGES_PATH . $media_rec->file_path . '" class="img-responsive center-block" />'
        . '                 </div>'
        . '                 <div class="panel-footer">'
        . '                     <h5>'
        . $product->name
        . '                     </h5>'
        . '                 </div>'
        . '             </div>'
        . '         </a>'
        . '     </div>';
    }
}

function renderRecommendedProducts($limit = null) {
    $product_rec = Product::finder()->findRecommendedProducts($limit);

    foreach ($product_rec as $product) {
        $media_rec = Media::finder()->findByProductID($product->product_id);
        echo '  <div class="col-xs-' . (12 / $limit) . '">'
        . '         <a href="' . HOST . 'manufacturer/' . $product->manufacturer_id . '/product/' . $product->product_id . '" class="latest-product">'
        . '             <div class="panel">'
        . '                 <div class="panel-body">'
        . '                     <img src="' . IMAGES_PATH . $media_rec->file_path . '" class="img-responsive center-block" />'
        . '                 </div>'
        . '                 <div class="panel-footer">'
        . '                     <h5>'
        . $product->name
        . '                     </h5>'
        . '                 </div>'
        . '             </div>'
        . '         </a>'
        . '     </div>';
    }
}

function renderBestsellerProducts($limit = null) {
//    $product_rec = Product::finder()->findRecommendedProducts($limit);
//
//    foreach ($product_rec as $product) {
//        $media_rec = Media::finder()->findByProductID($product->product_id);
//        echo '  <div class="col-xs-' . (12 / $limit) . '">'
//        . '         <a href="" class="latest-product">'
//        . '             <div class="panel">'
//        . '                 <div class="panel-body">'
//        . '                     <img src="' . IMAGES_PATH . $media_rec->file_path . '" class="img-responsive center-block" />'
//        . '                 </div>'
//        . '                 <div class="panel-footer">'
//        . '                     <h5>'
//        . $product->name
//        . '                     </h5>'
//        . '                 </div>'
//        . '             </div>'
//        . '         </a>'
//        . '     </div>';
//    }
}

function renderRecentlyBoughtProducts($limit = null) {
//    $product_rec = Product::finder()->findRecommendedProducts($limit);
//
//    foreach ($product_rec as $product) {
//        $media_rec = Media::finder()->findByProductID($product->product_id);
//        echo '  <div class="col-xs-' . (12 / $limit) . '">'
//        . '         <a href="" class="latest-product">'
//        . '             <div class="panel">'
//        . '                 <div class="panel-body">'
//        . '                     <img src="' . IMAGES_PATH . $media_rec->file_path . '" class="img-responsive center-block" />'
//        . '                 </div>'
//        . '                 <div class="panel-footer">'
//        . '                     <h5>'
//        . $product->name
//        . '                     </h5>'
//        . '                 </div>'
//        . '             </div>'
//        . '         </a>'
//        . '     </div>';
//    }
}
?>

<?php
require_once 'theme/header.php';
?>
<div class="col-md-3">
    <?php require_once 'theme/sidebar.php'; ?>
</div>
<div class="col-md-9">
    <h2 class="page-header">Gorące nowości</h2>
    <div class="row">
        <?php renderHotProducts(3); ?>
    </div>
    <h2 class="page-header">ProSzius.pl poleca</h2>
    <div class="row">
        <?php renderRecommendedProducts(3); ?>
    </div>
    <h2 class="page-header">Bestsellery</h2>
    <div class="row">
        <?php renderBestsellerProducts(3); ?>
    </div>
    <h2 class="page-header">Ostatnio kupione</h2>
    <div class="row">
        <?php renderRecentlyBoughtProducts(3); ?>
    </div>
</div>
<?php
require_once 'theme/footer.php';
?>