<?php
if (isset($name)) {
    if (isset($frd, $name)) {
        $frdVal = $frd[$name] ?? null;
    }
    $selected = $value ?? $frdVal ?? old($name);
}
?>

<select class="dropdown-primary md-form selectize {{$class}}" name="{{$name}}" multiple searchable="Search here..">
    <option disabled>{{$text}}</option>
        @forelse($selected ??[] as $object)
            <option class="selectize-dropdown-content" value="{{$object->getKey()}}" selected>
                {{$object->getName()}}</option>
        @empty
        @endforelse

    @forelse($list as $object)
        <option class="selectize-dropdown-content" value="{{$object->getKey()}}" >
            {{$object->getName()}}</option>
    @empty
    @endforelse
</select>
