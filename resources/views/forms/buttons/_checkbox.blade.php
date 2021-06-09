<?php
/** Имя */
$name = $name ?? null;
/** Класс */
$class = $class ?? null;
/** Имя массива разделенное точками  */
$nameDot = strpos($name, '[') !== false ? str_replace(['[]', '[', ']'], ['', '.', ''], $name) : $name;
/** Имя */
$value = $value ?? (isset($frd) ? \Illuminate\Support\Arr::get($frd, $nameDot) : old($name));
$disabled = $disabled ?? null;
if (!isset($checked) && 'on' === $value) {
    $checked = true;
} else {
    $checked = false;
}
$attributes = $attributes ?? array();
$title = $title ?? null;
if (true !== $checked){
    $style = null;
}
?>


<label class="btn btn-light  {{ true === $checked ? 'active' : null }} btn-sm"  style="{{ $style }}" title="{{ $title  }}">
    {{ Form::checkbox($name,$value ?? null,$checked ?? null,[
'class'=>' form-check-input '.($errors->has($name) ? ' is-invalid ' : null).' '.$class,
'required'=>$required ?? null,
'placeholder'=>$placeholder ?? null,
'disabled'=>$disabled,
'autocomplete'=>'off',
'form'=>$form ?? null,
]+$attributes) }}
    {!! $text !!}
</label>
