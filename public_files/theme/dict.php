<?php

class Dict {

    static $FootTypeArray = array(
        Type::FOOT_NEUTRAL => 'neutralna',
        Type::FOOT_PRONATION => 'pronująca',
        Type::FOOT_SUPINATION => "supinująca"
    );

    static function getValue($key, $array) {
        return self::${$array}[$key];
    }

}
