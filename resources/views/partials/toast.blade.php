 @if (session()->has('toast'))
     @php
         $toast = session('toast');
         $toast['variant'] ??= 'success';
         $toast['heading'] ??= '';
     @endphp
     <div x-data x-init='$nextTick(() => { $flux.toast(@json($toast)) })'></div>
 @endif
