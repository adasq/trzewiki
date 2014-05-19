<?php
require_once 'theme/config.php';

if (isset($_SESSION['customer_id'])) {
    if (isset($_POST['cart_item_id'])) {

        $cart_item_rec = CartItem::finder()->findByPk($_POST['cart_item_id']);
        $cart_item_rec->deleted = 1;
        $cart_item_rec->saveRecord();
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }
    ?>

    <?php
    require_once 'theme/header.php';
    ?>

    <?php
    $_SESSION['total'] = 0;
    function renderCartItems() {
        $cart_item_rec = CartItem::finder()->findAll("cart_id = :cart_id AND deleted = 0", array(":cart_id" => $_SESSION['cart_id']));

        foreach ($cart_item_rec as $cart_item) {
            $item_rec = Item::finder()->findByPk($cart_item->item_id);
            $item_rec->price2 = ($item_rec->price2 == null) ? 9999999 : $item_rec->price2;
            $size_rec = Size::finder()->findByPk($item_rec->size_id);
            $product_rec = Product::finder()->findByPk($item_rec->product_id);

            echo '  <tr>'
            . '         <td>'
            . '             <a href="' . HOST . 'manufacturer/' . $product_rec->manufacturer_id . '/product/' . $product_rec->product_id . '" title="Przejdź do strony produktu"><h4>' . $product_rec->name . '<small> ' . $size_rec->cm . ' CM / ' . $size_rec->euro . ' EUR / ' . $size_rec->us . ' US / ' . $size_rec->uk . ' UK</small></h4></a>'
            . '         </td>'
            . '         <td class="text-center">'
            . min(array($item_rec->price, $item_rec->price2))
            . '         </td>'
            . '         <td>'
            . '             <form method="post" action="' . $_SERVER['REQUEST_URI'] . '">'
            . '                 <input type="hidden" name="cart_item_id" value="' . $cart_item->cart_item_id . '">'
            . '                 <button type="submit" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>'
            . '             </form>'
            . '         </td>'
            . '     </tr>';
            $_SESSION['total'] += min(array($item_rec->price, $item_rec->price2));
        }
    }
    ?>
    <div class="col-xs-10 col-md-offset-1">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Twój koszyk</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-hover">
                    <tr>
                        <th class="text-center">Produkt</th>
                        <th class="text-center">Cena (PLN)</th>
                        <th></th>
                    </tr>
                    <?php renderCartItems(); ?>
                </table>
            </div>
            <div class="panel-footer">
                <div class="text-right">
                    <h4>Suma: <b><?php echo $_SESSION['total']; ?></b> PLN</h4>
                    <a href="<?php echo HOST; ?>pay" class="btn btn-lg btn-success"><span class="glyphicon glyphicon-usd"></span> Płacę!</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    require_once 'theme/footer.php';
    ?>

<?php } ?>