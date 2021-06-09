<?php
if (isset($name)) {
    if (isset($frd, $name)) {
        $frdVal = $frd[$name] ?? null;
    }
    $type = $type ?? 'checkbox';

    /**
     * Конструкция для работы с именами массивов вида: example[first_item][last_item]
     */
    $class = $class ?? null;
    $nameDot = strpos($name, '[') !== false ? str_replace(['[]', '[', ']'], ['', '.', ''], $name) : $name;
    $nameDotSlug = \Illuminate\Support\Str::slug(str_replace('.', '-', $nameDot));
    $value = $value ?? (isset($frd) ? \Illuminate\Support\Arr::get($frd, $nameDot) : old($name));
    $value = $value ?? $frdVal ?? old($name);
    $fileInputId = $fileInputId ?? uniqid('file-input-' . $nameDotSlug . '-', false);
    $disabled = $disabled ?? null;
    if (!isset($checked) && 'on' === $value){
        $checked = true;
    }
}
?>

<div class="form-check">
    {{ Form::checkbox($name,$value ?? null,$checked ?? null,[
  'class'=>' form-check-input '.($errors->has($name) ? ' is-invalid ' : null).' '.$class,
  'required'=>$required ?? null,
  'placeholder'=>$placeholder ?? null,
  'id'=>$fileInputId,
  'disabled'=>$disabled,
  ]+($attributes ?? array())) }}

    @if (isset($label))
        <label class="form-check-label" for="{{ $fileInputId }}">
            {!! $label !!}
        </label>
    @endif
    @if (isset($text))
        <small class="form-text text-muted">{!! $text !!}</small>
    @endif

</div>
