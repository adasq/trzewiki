<?php
require_once 'theme/header.php';
?>

<?php
if (isset($_GET['id'])) {
    $product_rec = Product::finder()->findByPk($_GET['id']);
} else {
    $product_rec == NULL;
}

function renderGallery($product_id) {
    $media_rec = Media::finder()->findAllByProductID($product_id);

    if (count($media_rec) == 0) {
        showAlert('danger', 'Brak zdjęć');
    } else {
        echo '  <div class="image_primary">'
        . '         <a href="' . IMAGES_PATH . $media_rec[0]->file_path . '" class="fancybox">'
        . '             <img id="image_primary" src="' . IMAGES_PATH . $media_rec[0]->file_path . '" class="img-responsive center-block" />'
        . '         </a>'
        . '     </div>';
    }
    if (count($media_rec) > 1) {
        for ($i = 0; $i < count($media_rec); $i++) {
            echo '  <div class="col-xs-6">'
            . '         <a href="#" class="image_secondary" title="Kliknij, aby zobaczyć"><img src="' . IMAGES_PATH . $media_rec[$i]->file_path . '" class="img-responsive center-block" /></a>'
            . '     </div>';
        }
    }
}

function renderAvailableSize($product_id) {
    $item_rec = Item::finder()->findAllSizes($product_id);
    if (count($item_rec) == 0) {
        showAlert('danger', 'Produkt jest chwilowo niedostepny');
    } else {
        echo '  <div class="input-group">'
        . '         <select ID="available_sizes" name="available_sizes" class="form-control">';
        foreach ($item_rec as $item) {
            echo '      <option value="' . $item->size_id . '">' . $item->cm . ' CM / ' . $item->euro . ' EUR / ' . $item->us . ' US / ' . $item->uk . ' UK</option>';
        }
        echo '"     </select>'
        . '         <span class="input-group-btn">'
        . '             <button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Do koszyka</button>'
        . '         </span>'
        . '     </div>';
    }
}

function renderPrices($product_id) {
    $item_rec = Item::finder()->findAll("deleted = 0 AND product_id = :product_id", array(":product_id" => $product_id));

    if (count($item_rec) == 1) {
        if ($item_rec[0]->price2 !== null) {
            echo '  <h5 class="del">Stara cena: ' . $item_rec[0]->price . ' PLN</h5>'
            . '     <h3>Nowa cena: ' . $item_rec[0]->price2 . ' PLN</h3>';
        } else {
            echo '  <h3>Cena: ' . $item_rec[0]->price . ' PLN</h3>';
        }
    } else {
        $min_price = 99999;
        $max_price = 0;
        foreach ($item_rec as $item) {
            if ($item->price2 > 0) {
                if ($min_price > $item->price2) {
                    $min_price = $item->price2;
                } else if ($max_price < $item->price2) {
                    $max_price = $item->price2;
                }
            } else {
                if ($min_price > $item->price) {
                    $min_price = $item->price;
                } else if ($max_price < $item->price) {
                    $max_price = $item->price;
                }
            }
        }
        echo '  <h3>Cena: ' . $min_price . ' - ' . $max_price . ' PLN</h3>';
    }
}
?>

<div class="col-md-3">
    <?php require_once 'theme/sidebar.php'; ?>
</div>
<div class="col-md-9">
    <?php
    if (!isset($_GET['id']) || $product_rec == NULL) {
        showAlert('danger', 'Wybrany produkt nie istnieje');
    } else {
        ?>
        <h2 class="page-header">
            <?php echo $product_rec->name; ?>
            <?php
            if ($product_rec->status != NULL) {
                if ($product_rec->status == Product::STATUS_NEW) {
                    echo '<span class = "label label-danger">Nowość</span>';
                } else if ($product_rec->status == Product::STATUS_PROMOTION) {
                    echo '<span class = "label label-success">Promocja</span>';
                } else if ($product_rec->status == Product::STATUS_RECOMMENDED) {
                    echo '<span class = "label label-primary">Polecamy</span>';
                } else if ($product_rec->status == Product::STATUS_SALE) {
                    echo '<span class = "label label-info">Wyprzedaż</span>';
                }
            }
            ?>
        </h2>
        <div class = "row">
            <div class = "col-md-5">
                <?php renderGallery($product_rec->product_id)
                ?>
            </div>
            <div class="col-md-7">
                <div class="form-inline">
                    <?php renderPrices($product_rec->product_id); ?>
                </div>
                <div class="form-inline">
                    <?php renderAvailableSize($product_rec->product_id) ?>
                </div>
                <div class="product-description">
                    <?php echo nl2br($product_rec->description); ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<?php
require_once 'theme/footer.php';
?>
<link rel="stylesheet" href="http://localhost/trzewiki/public_files/js/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script src="http://localhost/trzewiki/public_files/js/product.js" type="text/javascript"></script>
<script src="http://localhost/trzewiki/public_files/js/fancybox/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript" ></script>

