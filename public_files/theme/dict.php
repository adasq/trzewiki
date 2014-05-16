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

    static function getValue($key, $array) {
        return self::${$array}[$key];
    }

}
