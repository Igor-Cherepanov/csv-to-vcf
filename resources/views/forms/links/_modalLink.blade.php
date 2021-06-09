<div class="text-truncate {{ $class ?? null }}"
     data-toggle="modal"
     data-target="#defaultModal"
     data-modal-title="{{ $title ?? null }}"
     data-modal-iframe="{{ $href }}"
     style="width: {{ $width ?? 1000 }}">

   {!!  $label ?? 'Undefined label'  !!}
</div>
