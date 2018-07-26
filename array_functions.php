<?php
/*
Search Associative Array with Wildcard in PHP
https://magp.ie/2013/04/17/search-associative-array-with-wildcard-in-php/
*/
function array_key_exists_wildcard ( $array, $search, $return = '' ) {
    $search = str_replace( '\*', '.*?', preg_quote( $search, '/' ) );
    $result = preg_grep( '/^' . $search . '$/i', array_keys( $array ) );
    if ( $return == 'key-value' )
        return array_intersect_key( $array, array_flip( $result ) );
    return $result;
}
 
function array_value_exists_wildcard ( $array, $search, $return = '' ) {
    $search = str_replace( '\*', '.*?', preg_quote( $search, '/' ) );
    $result = preg_grep( '/^' . $search . '$/i', array_values( $array ) );
    if ( $return == 'key-value' )
        return array_intersect( $array, $result );
    return $result;
}
 
$array = array(
    'test_123'   => 'sbr123',
    'Test_12345' => 'bbb456',
    'test_222'   => 'bry789',
    'test_ewrwe' => 'abc777',
    't1est_eee'  => 'def950'
);
 
$search = 'test*';
print_r( array_key_exists_wildcard( $array, $search ) );
print_r( array_key_exists_wildcard( $array, $search, 'key-value' ) );
 
$search = 'b*';
print_r( array_value_exists_wildcard( $array, $search ) );
print_r( array_value_exists_wildcard( $array, $search, 'key-value' ) );
 
/*
Outputs:
Array
(
    [0] => test_123
    [1] => Test_12345
    [2] => test_222
    [3] => test_ewrwe
)
Array
(
    [test_123] => sbr123
    [Test_12345] => bbb456
    [test_222] => bry789
    [test_ewrwe] => abc777
)
Array
(
    [1] => bbb456
    [2] => bry789
)
Array
(
    [Test_12345] => bbb456
    [test_222] => bry789
)
*/