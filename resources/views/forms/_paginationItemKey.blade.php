<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator $elements
 */
?>
@if(isset($elements,$i))
    <span class="ordering-key">
          @if ('LengthAwarePaginator' === class_basename($elements))
            {{ ($elements->perPage() * ($elements->currentPage() - 1)) + ($i+1) }}
        @else
            {{ ++$i }}
        @endif
    </span>
@endif
