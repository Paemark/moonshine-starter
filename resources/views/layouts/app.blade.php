<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0f172a">
    <title>@yield('title', 'PMD SaaS Starter')</title>
    <meta name="description" content="@yield('meta_description', 'A secure, modern Laravel SaaS starter with MoonShine, Fortify authentication, role-based access control, and Laravel Restify APIs.')">
    <meta name="robots" content="@yield('robots', 'index, follow')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="PMD SaaS Starter">
    <meta property="og:title" content="@yield('title', 'PMD SaaS Starter')">
    <meta property="og:description" content="@yield('meta_description', 'A secure, modern Laravel SaaS starter with MoonShine, Fortify authentication, role-based access control, and Laravel Restify APIs.')">
    <meta property="og:url" content="@yield('canonical_url', url()->current())">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="min-h-screen bg-white text-slate-900 antialiased">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[100] focus:rounded-lg focus:bg-white focus:px-4 focus:py-3 focus:font-semibold focus:text-slate-900 focus:shadow-lg">Skip to main content</a>

    <header class="fixed inset-x-0 top-0 z-50 border-b border-slate-200/80 bg-white/90 shadow-sm shadow-slate-900/[0.03] backdrop-blur-xl">
        <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">
            <div class="flex min-h-16 items-center justify-between gap-4 py-3 sm:min-h-20">
                <a href="/" aria-label="PMD SaaS Starter home" class="group inline-flex min-w-0 items-center gap-3 rounded-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">
                    <span aria-hidden="true" class="flex size-10 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-primary to-primary-hover text-sm font-black tracking-tight text-white shadow-md shadow-primary/20">PMD</span>
                    <span class="min-w-0">
                        <span class="block truncate text-base font-extrabold tracking-tight text-slate-950 sm:text-lg">PMD SaaS Starter</span>
                        <span class="hidden text-xs font-medium text-slate-500 sm:block">A secure foundation for SaaS</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-2 md:flex" aria-label="Main navigation">
                    <a href="/#features" class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-950 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">Features</a>
                    @auth
                        <span class="mx-2 max-w-56 truncate text-sm text-slate-500">Welcome back, <span class="font-semibold text-slate-900">{{ Auth::user()->name }}</span></span>
                        <a href="/admin" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-gradient-to-r from-primary to-primary-hover px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">Dashboard <span class="ml-2" aria-hidden="true">↗</span></a>
                        <form method="POST" action="/admin/logout" class="inline-flex">
                            @csrf
                            <button type="submit" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:border-slate-300 hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">Log out</button>
                        </form>
                    @else
                        <a href="/admin/login" class="rounded-lg px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 hover:text-slate-950 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary">Log in</a>
                        <a href="/admin/login" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-gradient-to-r from-primary to-primary-hover px-5 py-2.5 text-sm font-bold text-white shadow-md shadow-primary/20 transition hover:-translate-y-0.5 hover:shadow-lg focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">Get started <span class="ml-2" aria-hidden="true">→</span></a>
                    @endauth
                </nav>

                <details class="relative md:hidden">
                    <summary aria-label="Open navigation menu" class="flex size-11 cursor-pointer list-none items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary [&::-webkit-details-marker]:hidden">
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16"/></svg>
                    </summary>
                    <nav aria-label="Mobile navigation" class="absolute right-0 top-[calc(100%+0.75rem)] w-[min(20rem,calc(100vw-2rem))] rounded-2xl border border-slate-200 bg-white p-3 shadow-2xl shadow-slate-900/15">
                        <a href="/#features" class="block rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Explore features</a>
                        @auth
                            <div class="border-t border-slate-100 px-4 py-3 text-sm text-slate-500">Signed in as <span class="font-semibold text-slate-900">{{ Auth::user()->name }}</span></div>
                            <a href="/admin" class="mt-1 block rounded-xl bg-gradient-to-r from-primary to-primary-hover px-4 py-3 text-center text-sm font-bold text-white">Open dashboard</a>
                            <form method="POST" action="/admin/logout" class="mt-2">
                                @csrf
                                <button type="submit" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">Log out</button>
                            </form>
                        @else
                            <a href="/admin/login" class="mt-1 block rounded-xl px-4 py-3 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">Log in</a>
                            <a href="/admin/login" class="mt-1 block rounded-xl bg-gradient-to-r from-primary to-primary-hover px-4 py-3 text-center text-sm font-bold text-white">Get started</a>
                        @endauth
                    </nav>
                </details>
            </div>
        </div>
    </header>

    <main id="main-content" class="pt-16 sm:pt-20">
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
