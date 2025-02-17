@props(['title'=>'','footerLinks'=>null])

<x-base-layout  :$title  >
    
<x-layouts.header/>
{{$slot}}
</x-base-layout>