<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title>{{ config('app.name', 'Laravel') }}</title>
    @viteReactRefresh
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
    @inertiaHead
  </head>
  <body class="bg-gray-50 dark:bg-gray-900 antialiased">
    @inertia
  </body>
</html>
