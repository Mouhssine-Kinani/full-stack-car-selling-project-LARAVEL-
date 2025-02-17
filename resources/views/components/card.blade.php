@props(['color','bgColor'=>'white'])

<div {{
    $attributes->merge(['lang'=>'ar'])
    ->class("card card-text-$color card-bg-$bgColor")

}} >
    <div {{$title->attributes->class('card-header')}}>
        {{$title}}
    </div> 
    user card components
    {{$slot}}
    <div class="card-footer">{{$footer}}</div>
</div>