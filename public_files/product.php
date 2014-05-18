<?php
require_once 'theme/header.php';
?>

<?php
if (isset($_GET['product_id'])) {
    $product_rec = Product::finder()->findByPk($_GET['product_id']);
    if ($product_rec !== null) {
        $size_rec = Size::finder()->find("size_id IN (SELECT size_id FROM items WHERE product_id = :product_id AND deleted = 0) AND deleted = 0", array(":product_id" => $product_rec->product_id));
        if ($size_rec !== null) {
            $_GET['sex'] = $size_rec->sex;
        } else {
            $product_rec = NULL;
        }
    } else {
        $product_rec = NULL;
    }
} else {
    $product_rec = NULL;
}

function renderSpecification($product_id) {
    $type_rec = Type::finder()->findAllByProductID($product_id);

    echo '  <div class="row">'
    . '         Typ stopy:';
    foreach ($type_rec as $type) {
        if ($type->type_name == Type::FOOT_NEUTRAL) {
            echo '  <span class="label label-success">' . Dict::getValue($type->type_name, "FootTypeArray") . '</span>';
        } else if ($type->type_name == Type::FOOT_SUPINATION) {
            echo '  <span class="label label-warning">' . Dict::getValue($type->type_name, "FootTypeArray") . '</span>';
        } else if ($type->type_name == Type::FOOT_PRONATION) {
            echo '  <span class="label label-danger">' . Dict::getValue($type->type_name, "FootTypeArray") . '</span>';
        }
    }
    echo '  </div>';

    echo '  <div class="row">'
    . '         Rodzaj nawierzchni:';
    foreach ($type_rec as $type) {
        if ($type->type_name == Type::SHOE_ROAD) {
            echo '  <span class="label label-default">' . Dict::getValue($type->type_name, "ShoeGroundTypeArray") . '</span>';
        } else if ($type->type_name == Type::SHOE_TERRAIN) {
            echo '  <span class="label label-primary">' . Dict::getValue($type->type_name, "ShoeGroundTypeArray") . '</span>';
        }
    }
    echo '  </div>';

    echo '  <div class="row">'
    . '         Przeznaczenie:';
    foreach ($type_rec as $type) {
        if ($type->type_name == Type::SHOE_RACE) {
            echo '  <span class="label label-success">' . Dict::getValue($type->type_name, "ShoeDestinationArray") . '</span>';
        } else if ($type->type_name == Type::SHOE_TRAINING) {
            echo '  <span class="label label-danger">' . Dict::getValue($type->type_name, "ShoeDestinationArray") . '</span>';
        }
    }
    echo '  </div>';
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
            echo '  <div class="col-xs-4 gallery-item">'
            . '         <a href="#" class="image_secondary" title="Kliknij, aby zobaczyć"><img src="' . IMAGES_PATH . $media_rec[$i]->file_path . '" class="img-responsive center-block" /></a>'
            . '     </div>';
        }
    }
}

function renderAvailableSize(
$product_id) {
    $item_rec = Item::finder()->findAllSizes($product_id);
    if (count($item_rec) == 0) {
        showAlert('danger', 'Produkt jest chwilowo niedostepny');
    } else {
        echo '  <form id="add_item_form" role="form" class="from-inline">'
        . '         <input type="hidden" id="host" value="' . HOST . '">'
        . '         <input type="hidden" id="item_id"  name="item_id" value="">'
        . '         <input type="hidden" name="product_id" value="' . $_GET['product_id'] . '">'
        . '         <div class="input-group">'
        . '             <select ID="available_sizes" name="available_sizes" class="form-control">'
        . '                 <option value="" disabled selected>Wybierz swój rozmiar...</option>';
        foreach ($item_rec as $item) {
            echo '          <option value="' . $item->size_id . '">' . $item->cm . ' CM / ' . $item->euro . ' EUR / ' . $item->us . ' US / ' . $item->uk . ' UK</option>';
        }
        echo '"         </select>'
        . '             <span class="input-group-btn">'
        . '                 <button ID="add_to_cart" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-shopping-cart"></span> Do koszyka</button>'
        . '             </span>'
        . '         </div>'
        . '     </form>'
        . '     <div ID="need_login" class="alert alert-warning"><a href="' . HOST . 'login/' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '" title="Kliknij, aby przejść do panelu logowania">Zaloguj się</a> i dodaj ponownie przedmiot.</div>'
        . '     <div ID="retry" class="alert alert-danger">Wybierz ponownie rozmiar lub/i przestań kombinować</div>';
    }
}

function renderPrices($product_id, $status) {
    $item_rec = Item::finder()->findAll("deleted = 0 AND product_id = :product_id", array(":product_id" => $product_id));

    $min_price = 99999;
    $max_price = 0;
    $diff_prices = 0;
    foreach ($item_rec as $item) {
        if ($item->price2 > 0) {
            if ($min_price > $item->price2) {
                $min_price = $item->price2;
                $diff_prices++;
            } else if ($max_price < $item->price2) {
                $max_price = $item->price2;
                $diff_prices++;
            }
        }
        if ($min_price > $item->price) {
            $min_price = $item->price;
            $diff_prices++;
        } else
        if ($max_price < $item->price) {
            $max_price = $item->price;
            $diff_prices++;
        }
    }
    if ($status == Product::STATUS_PROMOTION && $diff_prices = 2) {
        echo '  <h4 class="del">Stara cena: ' . $max_price . ' PLN</h4>'
        . '     <h3>Nowa cena: ' . $min_price . ' PLN</h3>';
    } else {
        if ($min_price != $max_price && $max_price != 0) {
            echo '  <h3>Cena: ' . $min_price . ' - ' . $max_price . ' PLN</h3>';
        } else {
            echo '  <h3>Cena: ' . $min_price . ' PLN</h3>';
        }
    }
}
?>

<div class="col-md-3">
    <?php require_once 'theme/sidebar.php'; ?>
</div>
<div class="col-md-9">
    <?php
    if (!isset($_GET['product_id']) || $product_rec == NULL) {
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
                    <?php renderSpecification($product_rec->product_id); ?>
                </div>
                <div class="form-inline" id="price">
                    <?php renderPrices($product_rec->product_id, $product_rec->status); ?>
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
<link rel="stylesheet" href="<? echo JS_PATH; ?>fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script src="<? echo JS_PATH; ?>product.js" type="text/javascript"></script>
<script src="<? echo JS_PATH; ?>fancybox/jquery.fancybox.pack.js?v=2.1.5" type="text/javascript" ></script>

