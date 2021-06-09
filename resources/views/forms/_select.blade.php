<?php
$frdVal = null;
if (isset($frd,$name)) {
    $frdVal = $frd[$name] ?? null;
}
$random_int = random_int(1, 100000);
$id_input = 'input_' . $random_int . '_' . Str::slug($name ?? '');

$placeholder = $placeholder ?? null;

$disabled = $disabled ?? null;
$list = $list ?? array();

/**
 * Конструкция для работы с именами массивов вида: example[first_item][last_item]
 */
$nameDot = strpos($name, '[') !== false ? str_replace(['[]', '[', ']'], ['', '.', ''], $name) : $name;
$value = $value ?? (isset($frd) ? \Illuminate\Support\Arr::get($frd, $nameDot) : old($name));

$multiple = $multiple ?? false;
?>
<div
    class=" form-group position-relative {{ $classWrap??null }} {{ ($errors->has(str_replace(['[',']'],['.',''],$name)) === true || $errors->has(str_replace(['[',']'],['',''],$name)) === true) ? ' has-danger' : '' }}">
    @isset($label)
        <label class="form-control-label {{ $labelClass??null }}"
               for="{{ $id_input }}">{!!  $label !!}&nbsp;</label>
    @endisset
    {{ Form::select(
    $name,
    $list,
    $value,
    [
    'id'=>$id_input,
    'class'=>'form-control '
    .' '.($class ?? null).' '
    .($errors->has(str_replace(['[',']'],['.',''],$name)) ? ' is-invalid ' : '')
    .($errors->has(str_replace(['[',']'],['',''],$name)) ? ' is-invalid ' : '')
    .($class ?? ''),
    'disabled'=>$disabled,
    'required'=>(isset($required) && $required ? 'required' : null),
    'placeholder'=>$placeholder,
    'multiple'=>$multiple,
    ]+($attributes ?? [])) }}

    @if(isset($feedback))
        <div class=" invalid-feedback ">{{ $feedback }}</div>
    @elseif($errors->has(str_replace(['[',']'],['',''],$name)) === true)
        <div class=" invalid-feedback ">{{ $errors->first(str_replace(['[',']'],['',''],$name))}}</div>
    @elseif($errors->has(str_replace(['[',']'],['.',''],$name)) === true)
        <div class=" invalid-feedback ">{{ $errors->first(str_replace(['[',']'],['.',''],$name)) }}</div>
    @endif

    @isset($text)
        <small class="form-text text-muted">{!! $text !!}</small>
    @endisset
</div>

