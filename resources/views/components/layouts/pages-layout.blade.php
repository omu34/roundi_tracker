<!DOCTYPE html>
<html lang="en">

<head>
    {{-- ✅ Basic Meta --}}
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    {{-- ✅ SEO & Social --}}
    <title>{{ $title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $description ?? 'Welcome to ' . config('app.name') }}" />
    <meta name="keywords" content="{{ $keywords ?? config('app.name') . ', ecommerce, shop' }}" />
    <meta name="author" content="{{ $author ?? config('app.name') }}" />
    {{-- Open Graph / Facebook --}}
    <meta property="og:title" content="{{ $title ?? config('app.name') }}" />
    <meta property="og:description" content="{{ $description ?? 'Welcome to ' . config('app.name') }}" />
    <meta property="og:image" content="{{ $ogImage ?? asset('images/og-default.jpg') }}" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $title ?? config('app.name') }}" />
    <meta name="twitter:description" content="{{ $description ?? 'Welcome to ' . config('app.name') }}" />
    <meta name="twitter:image" content="{{ $ogImage ?? asset('images/og-default.jpg') }}" />
    {{-- ✅ Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen flex flex-col antialiased bg-gray-50 text-gray-900">

    <div class="flex-grow">

        <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
            @yield('content')
        </main>
    </div>
        {{-- ✅ Scripts --}}
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", () => {
            const trackerRoute = "{{ route('redirect.link') }}";

            document.querySelectorAll('a[href]').forEach(link => {
                const href = link.getAttribute('href');

                // Check if it's an external link
                if (href && href.startsWith('http') && !href.includes(window.location.host)) {

                    link.addEventListener('click', function(e) {
                        // Prevent default click
                        e.preventDefault();

                        // Build the tracking URL
                        const trackUrl = `${trackerRoute}?url=${encodeURIComponent(href)}`;

                        // Send the user to the tracker, which will log and redirect
                        window.open(trackUrl, link.target || '_blank');
                    });
                }
            });
        });
    </script> --}}


    <script>
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll('a[href]').forEach(link => {
    const href = link.getAttribute('href');
    if (href && href.startsWith('http') && !href.includes(window.location.host)) {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const trackUrl = `/r?url=${encodeURIComponent(href)}`;
        window.open(trackUrl, '_blank');
      });
    }
  });
});
</script>


</body>

</html>
