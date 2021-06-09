<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $elements
 */
?>
@if(isset($elements) &&  'LengthAwarePaginator' === class_basename($elements) )
    <div class="pt-3 text-center w-100 d-flex justify-content-center">
        {!! $elements->appends($frd ?? [])->render() !!}
    </div>
@endif
