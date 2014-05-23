<?php

class Dict {

    static $FootTypeArray = array(
        Type::FOOT_NEUTRAL => 'neutralna',
        Type::FOOT_PRONATION => 'pronująca',
        Type::FOOT_SUPINATION => "supinująca"
    );
    static $ShoeDestinationArray = array(
        Type::SHOE_RACE => 'zawody',
        Type::SHOE_TRAINING => 'treningi'
    );
    static $ShoeGroundTypeArray = array(
        Type::SHOE_ROAD => 'ulica/szosa',
        Type::SHOE_TERRAIN => 'teren'
    );
    static $CartStatusArray = array(
        Cart::STATUS_NEW => 'nowy'
    );
    static $TransactionStatusArray = array(
        Transaction::STATUS_IN_PROGRESS => 'w trakcie realizacji',
        Transaction::STATUS_FINISHED => 'zakończona',
        Transaction::STATUS_ABORTED => 'anulowana'
    );
    static $ReceiptTypeArray = array(
        Transaction::RECEIPT_TYPE_BILL => 'rachunek',
        Transaction::RECEIPT_TYPE_INVOICE => 'faktura'
    );

    static function getValue($key, $array) {
        return self::${$array}[$key];
    }

}
