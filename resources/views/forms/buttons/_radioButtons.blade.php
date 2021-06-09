<div class="btn-group btn-group-toggle" data-toggle="buttons">
    @foreach ($values as $valueId =>  $valueName)
        <?php
        $checked = isset($frd[$name]) ? $frd[$name] === $valueId : false;
        ?>
        <label class="btn btn-outline-secondary {{ true === $checked ? ' active ' : null }}">
            {{ Form::radio($name,$valueId,$checked,['id'=>'option_'.$name.'_'.$valueId,'autocomplete'=>'off']) }}
               {!! $valueName !!}
        </label>
    @endforeach
</div>
