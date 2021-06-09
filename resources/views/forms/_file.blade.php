<?php
if (isset($name)) {
    if (isset($frd, $name)) {
        $frdVal = $frd[$name] ?? null;
    }

    $type = $type ?? 'text';
    $errors = $errors ?? null;

    /**
     * Конструкция для работы с именами массивов вида: example[first_item][last_item]
     */
    $nameDot = strpos($name, '[') !== false ? str_replace(['[]', '[', ']'], ['', '.', ''], $name) : $name;
    $nameDotSlug = \Illuminate\Support\Str::slug(str_replace('.','-',$nameDot));
    $value = $value ?? (isset($frd) ? \Illuminate\Support\Arr::get($frd, $nameDot) : old($name));
    $value = $value ?? $frdVal ?? old($name);
    $fileInputId = $fileInputId ?? uniqid('file-input-'.$nameDotSlug.'-', false);
    $required = $required ?? null;
    $autocomplete = $autocomplete ?? 'off';
    $attributes = $attributes ?? array();
    $label = $label ?? null;
    $class = ' custom-file-input js-custom-file-input ' .( $errors->has($name) ? ' is-invalid ' : ' ' ) .($class ?? '');
    $placeholder = $placeholder ?? null;
}
?>

<div class="form-group {{ $errors->has($name) ? ' has-danger ' : '' }}">
    @if (isset($label))
        <label>
            {{ $label }}
        </label>
    @endif

        <div class="custom-file">

            {{ Form::file(
   $name,
   [
   'required'=>$required,
   'id'=>$fileInputId,
   'class'=>$class,
   'placeholder'=>$placeholder,
   'autocomplete'=>$autocomplete,
   'data-value'=>$value,
   ]+$attributes
   ) }}
            <label class="custom-file-label" for="{{ $fileInputId }}">{!! $inputLabel ?? 'Файл...' !!}</label>

            @isset($text)
                <small class="form-text text-muted "> {!! $text   !!}</small>
            @endisset

            @if($errors->has($name) === true)
                <div class="invalid-feedback">{{ $errors->first($name) }}</div>
            @endif
        </div>

</div>







