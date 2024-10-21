<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config("app.name") . " - "}} @yield("title")</title>
  @yield("css")
    {{-- @vite(['resources/css/app.css','resources/js/app.ts']) --}}
  <script src="https://cdn.tailwindcss.com"></script>

    {{-- <link rel="stylesheet" href="{{asset("build/assets/app-BvqDx_09.css") }}"/>
    <script src="{{asset("build/assets/app-BLRLSM1J.js")}}"></script> --}}

</head>

<body class="h-screen font-sans login bg-cover" style="    background: url('{{asset("assets/images/Bank-PO-.png")}}');    background-repeat: no-repeat;
    background-size: cover;">
    <div class="container mx-auto h-full flex flex-1 justify-center items-center">
      <div class="w-full max-w-lg">
        <div class="leading-loose">
          @yield("content")
        </div>
      </div>
    </div>
    </body>
</html>