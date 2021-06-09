<?php
$class = $class ?? '';
$class .= ' js-select-ajax ';
$attributes = $attributes ?? array();

/**
 * JS select2 ajax attributes
 */
$attributes['data-store-url'] = $storeUrl ?? null;
$attributes['data-ajax--url'] = $ajaxUrl ?? $getUrl ?? null;
$attributes['data-ajax--cache'] = $ajaxCache ?? false;
$attributes['data-minimum-results-for-search'] = '5';

?>


@include('form._select',['classWrap'=>'overflow-hidden select2-wrapper-max-height'])
