<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $elements
 */
?>
@if(isset($elements) &&  'LengthAwarePaginator' === class_basename($elements) )
    {!! $elements->appends($frd ?? [])->render() !!}
@endif
