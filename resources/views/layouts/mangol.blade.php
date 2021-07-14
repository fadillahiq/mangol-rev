<!DOCTYPE html>
<html lang="en">

  {{-- head --}}
  <head>
    @include('includes.head')
  </head>

<body>
  {{-- navbar --}}
  @include('includes.navbar')
  {{-- end-navbar --}}

  {{-- header --}}
  <section class="section courses pb-4 p-3">
    <div class="container">
        @yield('header')
    </div>
  </section>
  {{-- end-header --}}

  {{-- content --}}
  <section class="section mb-5 pb-2">
    <div class="container">
        @yield('content')
    </div>
  </section>
  {{-- end-content --}}

  {{-- footer --}}
  @include('includes.footer')
  {{-- end-footer --}}

  {{-- scripts --}}
  @include('includes.script')
</body>
</html>
