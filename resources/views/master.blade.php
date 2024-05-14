<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('Backend/assets')}}/"
  data-template="vertical-menu-template-free"
>
  <head>
    @include('layout.head')
    @yield('css')
    
  </head>

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        @include('layout.sidebar')
          <div class="layout-page">
            @include('layout.navbar')
            @yield('content')
            @include('layout.footer')             
          </div>
      </div>     
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
    </div>

    @include('layout.js')
    @yield('js')
  </body>
</html>
