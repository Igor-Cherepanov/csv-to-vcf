<?php

/**
 * Конструкция для работы с именами массивов вида: example[first_item][last_item]
 */
$name = $name ?? null;
$nameDot = strpos($name, '[') !== false ? str_replace(['[]', '[', ']'], ['', '.', ''], $name) : $name;
$nameDotSlug = \Illuminate\Support\Str::slug(str_replace('.','-',$nameDot));
$fileInputId = $fileInputId ?? uniqid('file-input-'.$nameDotSlug.'-', false);
$disabled = $disabled ?? null;
?>
<div class="form-group {{ $errors->has($name) ? ' has-danger' : '' }}">
    @isset($label)
        <label class="form-control-label {{ $labelClass??null }}"
               for="{{ $fileInputId }}"> {!!  $label !!} </label>
    @endisset
    {{ Form::textarea(
    $name,
    old($name) ?? ($value ?? null),
    [
    'required'=>(isset($required) && $required ? 'required' : null),
    'id'=>$fileInputId,
    'class'=>'form-control form-control-sm '
    .($errors->has($name) ? ' is-invalid ' : '')
    .($class ?? ''),
    'placeholder'=>($placeholder ?? null),
    'autocomplete'=>($autocomplete ?? 'on'),
    'data-value'=>($value ?? null),
    'data-suggestions'=>'address',
    'disabled'=>$disabled,
    'rows'=>2,
    ]+($attributes ?? [])
    ) }}

        {{ Form::hidden($name.'_payload') }}

    @if(isset($feedback) || $errors->has($name) === true)
        <div class="invalid-feedback">{{ $feedback ?? $errors->first($name) }}</div>
    @endif

    @isset($text)
        <small class="form-text text-muted"> {!! $text   !!}</small>
    @endisset
</div>
