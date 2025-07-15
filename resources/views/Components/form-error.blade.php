@props(['name']) {{--Creates variable for name--}}

@error($name)
<p style="color: red; font-weight: bold;">{{ $slot }}</p>
@enderror
