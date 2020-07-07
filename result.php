<?php

// sort_desc");

function sort_desc($a, $b) {

    $k = 'value';

    if (empty($a[$k]) || empty($b[$k]))
        $b[$k] = 0;

    if ($a[$k] != $b[$k]) {
        return ( $a[$k] < $b[$k] ) ? 1 : -1;
    } else {
        //if ( $a[$k] == $b[$k] || !isset($a[$k]) || !isset($b[$k] ) ){
        return 0;
    }

    //return (strtotime($a[$k]) < strtotime($b[$k])) ? 1 : -1;
}

$day1Products = [
    ["name" => "1", "value" => 3, "cost" => 200],
    ["name" => "2", "value" => 33, "cost" => 100],
    ["name" => "3", "value" => 100, "cost" => 250],
    ["name" => "4", "value" => 10, "cost" => 500],
    ["name" => "5", "value" => 90, "cost" => 125],
];
$day2Products = [
    ["name" => "1", "value" => 2, "cost" => 1],
    ["name" => "2", "value" => 1000, "cost" => 1000],
];
$day3Products = [
    ["name" => "1", "value" => 99, "cost" => 1000],
    ["name" => "2", "value" => 95, "cost" => 100],
    ["name" => "3", "value" => 85, "cost" => 400],
    ["name" => "4", "value" => 15, "cost" => 500],
];

function maximizeValue($prod, $money = 1000) {
    // пишите код тут

    $res = [];
    $skipped = [];
    $prod_all = [];
    usort($prod, "sort_desc");
    
    for ($i = 0; $i < 3; $i ++) {

        $money_now = $money;
        $prod_new = [];

        foreach ($prod as $k => $v) {

            if (isset($skipped[$k]))
                continue;

            if ($money_now >= $v['cost']) {

                $prod_new['ar'][] = $v;

                if( !isset($prod_new['summ']) ){
                    $prod_new['summ'] = $v['value'];
                } else {
                    $prod_new['summ'] += $v['value'];
                }

                $money_now -= $v['cost'];

                if (empty($k_skip))
                    $k_skip = $k;

            }

        }

        $prod_all[$prod_new['summ']] = $prod_new['ar'];
        
        $skipped[$k_skip] = 1;

    }
    
    krsort($prod_all);
    
    foreach( $prod_all as $k => $v ){
        return [ 'summ' => $k, 'ar' => $v ];
    }
    
}

$a = maximizeValue($day1Products);
echo '<br/>1 - '.$a['summ'];
echo '<pre>'; print_r($a['ar']); echo '</pre>';

$a = maximizeValue($day2Products);
echo '<br/>2 - '.$a['summ'];
echo '<pre>'; print_r($a['ar']); echo '</pre>';

$a = maximizeValue($day3Products);
echo '<br/>3 - '.$a['summ'];
echo '<pre>'; print_r($a['ar']); echo '</pre>';

