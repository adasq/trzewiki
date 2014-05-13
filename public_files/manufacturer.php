<?php
require_once 'theme/header.php';
?>

<?php
if (isset($_GET['manufacturer_id'])) {
    $manufacturer_rec = Manufacturer::finder()->findByPK($_GET['manufacturer_id']);

    if ($manufacturer_rec !== null) {
        $product_rec = Product::finder()->findAllByManufacturerID($_GET['manufacturer_id'], $_GET['sex']);
    } else {
        $product_rec = NULL;
    }
} else {
    $product_rec = NULL;
}

function renderProducts($products) {
    $i = 0;
    foreach ($products as $product) {
        $media_rec = Media::finder()->findByProductID($product->product_id);
        echo '  <div class="col-xs-4">'
        . '         <a href="' . HOST . 'manufacturer/' . $product->manufacturer_id . '/product/' . $product->product_id . '" class="latest-product">'
        . '             <div class="panel">'
        . '                 <div class="panel-body">'
        . '                     <img src="' . IMAGES_PATH . $media_rec->file_path . '" class="img-responsive center-block" />'
        . '                 </div>'
        . '                 <div class="panel-footer">'
        . '                     <h5>'
        . $product->name
        . '                     </h5>'
        . '                     <div class="text-right">';
        renderPrices($product->product_id);
        echo '                  </div>'
        . '                 </div>'
        . '             </div>'
        . '         </a>'
        . '     </div>';
        if (($i + 1) % 3 == 0) {
            echo '  <div class="clearfix"></div>';
        }
        $i++;
    }
}

function renderPrices($product_id) {
    $item_rec = Item::finder()->findAll("deleted = 0 AND product_id = :product_id", array(":product_id" => $product_id));

    if (count($item_rec) == 1) {
        if ($item_rec[0]->price2 > 0) {
            echo '  <span class="del label label-danger">Stara cena: ' . $item_rec[0]->price . ' PLN</span><br />'
            . '     <span class="label label-success">Nowa cena: ' . $item_rec[0]->price2 . ' PLN</span>';
        } else {
            echo '  <span class="label label-success">Cena: ' . $item_rec[0]->price . ' PLN</span>';
        }
    } else {
        $min_price = 99999;
        $max_price = 0;
        foreach ($item_rec as $item) {
            if ($item->price2 > 0) {
                if ($min_price > $item->price2) {
                    $min_price = $item->price2;
                }
                if ($max_price < $item->price2) {
                    $max_price = $item->price2;
                }
            } else {
                if ($min_price > $item->price) {
                    $min_price = $item->price;
                }
                if ($max_price < $item->price) {
                    $max_price = $item->price;
                }
            }
        }
        echo '  <span class="label label-success">Cena: ' . $min_price . ' - ' . $max_price . ' PLN</span>';
    }
}
?>

<div class="col-md-3">
    <?php require_once 'theme/sidebar.php'; ?>
</div>
<div class="col-md-9">
    <?php
    if (!isset($_GET['manufacturer_id']) || $product_rec == NULL) {
        showAlert('danger', 'Wybrany producent nie istnieje lub nie posiadamy aktualnie produktów.');
    } else {
        ?>
        <h2 class="page-header">
            Produkty marki <?php echo $manufacturer_rec->name; ?>
        </h2>
        <form>
            <div class="input-group form-group">
                <span class="input-group-addon">Sortuj według</span>
                <select class="form-control">
                    <option value="1">Cena (rosnąco)</option>
                    <option value="2">Cena (malejąco)</option>
                </select>
                <div class="input-group-btn">
                    <button class="btn btn-primary">Sortuj</button>
                </div>
            </div>
        </form>
        <div class = "row">
            <?php renderProducts($product_rec); ?>
        </div>
    <?php } ?>
</div>
<?php
require_once 'theme/footer.php';
?>
<link rel="stylesheet" href="http://localhost/trzewiki/public_files/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script src="http://localhost/trzewiki/public_files/js/product.js" type="text/javascript"></script>
<script src="http://localhost/trzewiki/public_files/js/fancybox/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript" ></script>

