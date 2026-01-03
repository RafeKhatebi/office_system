<!DOCTYPE html>
<head>
    <title>{{ config('app.name', 'Office System') }}</title>
    {{-- react refresh why ? because it enables hot module replacement for React components during development --}}
    @viteReactRefresh
    @vite('resources/js/app.jsx')
    @inertiaHead
</head>
<body>
    @inertia
</body>
</html>