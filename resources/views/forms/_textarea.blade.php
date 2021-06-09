<?php
$name = $name ?? "";
$random_int = random_int(1, 100000);
$id_input = "input_".$random_int."_".Str::slug($name);
$disabled = $disabled ??  false;
?>
<div class="form-group {{ $errors->has($name) ? ' has-danger' : '' }}">
    @isset($label)
    <label class="form-control-label {{ $labelClass??null }}"
           for="{{ $id_input }}"> {!!  $label !!} </label>
    @endisset
    {{ Form::textarea(
    $name,
    old($name) ?? ($value ?? null),
    [
    'required'=>(isset($required) && $required ? 'required' : null),
    'id'=>$id_input,
    'class'=>'form-control form-control-sm '
    .($errors->has($name) ? ' is-invalid ' : '')
    .($class ?? ''),
    'placeholder'=>($placeholder ?? null),
    'rows'=>$rows ?? 2,
    'autocomplete'=>($autocomplete ?? 'on'),
    'data-value'=>($value ?? null),
    'disabled'=>$disabled,
    ]+($attributes ?? [])
    ) }}



        @if(isset($feedback) || $errors->has($name) === true)
    <div class="invalid-feedback">{{ $feedback ?? $errors->first($name) }}</div>
        @endif

        @isset($text)
    <small class="form-text text-muted"> {!! $text   !!}@isset($textPostfix) <span class="text-postfix">{{ $textPostfix }}</span>@endisset</small>
            @endisset


</div>
