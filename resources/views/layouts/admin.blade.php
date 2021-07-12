<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.includes.head')
    @stack('style')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      @include('admin.includes.navbar')
      <div class="main-sidebar">
        @include('admin.includes.sidebar')
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            @yield('header')
          </div>

          <div class="section-body">
            @yield('content')
          </div>
        </section>
      </div>
      @include('admin.includes.footer')
    </div>
  </div>

  <!-- General JS Scripts -->
  @include('admin.includes.script')
  @stack('script')
  <!-- Page Specific JS File -->
</body>
</html>
