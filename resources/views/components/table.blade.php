@props(['id' => 'table'])

<div class="table-responsive my-3">
    <table {{$attributes->merge(['class' => 'table border-1 border'])}} id="{{$id}}">
        {{$slot}}
    </table>
</div>
