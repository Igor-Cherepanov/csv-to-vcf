<?php
if (isset($name)) {
    if (isset($frd, $name)) {
        $frdVal = $frd[$name] ?? null;
    }
    $type = $type ?? 'text';

    /**
     * Конструкция для работы с именами массивов вида: example[first_item][last_item]
     */
    $nameDot = strpos($name, '[') !== false ? str_replace(['[]', '[', ']'], ['', '.', ''], $name) : $name;
    $value = $value ?? (isset($frd) ? \Illuminate\Support\Arr::get($frd, $nameDot) : old($name));
    $value = $value ?? $frdVal ?? old($name);
    $attributes = $attributes ?? array();
    $class = $class ?? null;
    if(isset($form)){
        $attributes['form'] = $form;
    }
}
?>

<div class="form-group {{ $groupClass ?? null }}">
    @if (isset($label))
        <label for="basic-url">{!! $label ?? null !!}&nbsp</label>
    @endif


    <div class="input-group">
        @isset($prefix)
            <div class="input-group-append">
                <span class="input-group-text">{!! $prefix !!}</span>
            </div>
        @endisset

        {{ Form::input($type ?? 'text',$name,$value ?? null,[
   'class'=>'form-control '.($errors->has($name) ? ' is-invalid ' : null).' '.$class,
   'id'=>$id ?? null,
   'style'=>$style ?? null,
   'onclick'=>$onclick ?? null,
   'onkeypress'=>$onkeypress ?? null,
   'required'=>$required ?? null,
   'placeholder'=>$placeholder ?? null,
   'disabled'=>$disabled ?? null,
   'step'=>$step ?? $attributes['step'] ?? null,
   'max'=>$max ?? $attributes['max']  ?? null,
   'min'=>$min ?? $attributes['min']  ?? null,

   ]+($attributes)) }}

        @isset($postfix)
            <div class="input-group-append">
                <span class="input-group-text">{!! $postfix !!}</span>
            </div>
        @endisset
        @if($errors->has($name) === true)
            <div class="invalid-feedback">{{ $errors->first($name) }}</div>
        @endif
    </div>


    @if (isset($text))
        <small class="form-text text-muted">{!! $text !!}@isset($textPostfix) <span class="text-postfix">{{ $textPostfix }}</span>@endisset</small>
    @endif


</div>



