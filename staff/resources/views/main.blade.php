
<!DOCTYPE html>
<html>
<head>
@include('partials._header')
 </head>

<body>
@include('partials._topbar')

 <main id="app">
          

      @include('partials._messages')
      @yield('pageContent')
        
       </main> 


@include('partials._footer')
@yield('scripts')
       </body>

       </html>