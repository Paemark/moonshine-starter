@extends('layouts.app')

@section('title', 'PMD SaaS Starter | Secure Laravel SaaS Boilerplate')
@section('meta_description', 'Build and ship SaaS products faster with PMD SaaS Starter: a secure Laravel foundation featuring MoonShine, Fortify authentication, role-based permissions, and Laravel Restify APIs.')

@section('content')
    <section class="relative isolate flex min-h-[calc(100svh-4rem)] items-center overflow-hidden bg-slate-950 sm:min-h-[calc(100svh-5rem)]" aria-labelledby="hero-title">
        <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
            <div class="absolute -left-40 -top-32 size-[28rem] rounded-full bg-primary/25 blur-3xl sm:size-[38rem]"></div>
            <div class="absolute -bottom-48 -right-40 size-[30rem] rounded-full bg-secondary/20 blur-3xl sm:size-[40rem]"></div>
            <div class="absolute inset-0 opacity-[0.08]" style="background-image: linear-gradient(rgba(255,255,255,.35) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.35) 1px, transparent 1px); background-size: 44px 44px;"></div>
            <div class="absolute inset-x-0 bottom-0 h-48 bg-gradient-to-t from-slate-950 to-transparent"></div>
        </div>

        <div class="mx-auto w-full max-w-screen-2xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-5xl text-center">
                <div class="mb-7 inline-flex max-w-full items-center gap-2 rounded-full border border-white/15 bg-white/[0.07] px-4 py-2 text-left text-xs font-semibold text-slate-200 shadow-lg shadow-black/10 backdrop-blur sm:text-sm">
                    <span class="relative flex size-2 shrink-0" aria-hidden="true"><span class="absolute inline-flex size-full animate-ping rounded-full bg-emerald-400 opacity-60 motion-reduce:animate-none"></span><span class="relative inline-flex size-2 rounded-full bg-emerald-400"></span></span>
                    Secure foundation · Modern Laravel stack
                </div>

                <h1 id="hero-title" class="text-balance text-4xl font-black tracking-tight text-white sm:text-6xl md:text-7xl lg:text-8xl">
                    Build faster.
                    <span class="mt-1 block bg-gradient-to-r from-primary via-primary-hover to-secondary bg-clip-text text-transparent">Ship smarter.</span>
                </h1>

                <p class="mx-auto mt-6 max-w-3xl text-pretty text-base leading-8 text-slate-300 sm:mt-8 sm:text-xl sm:leading-9">
                    Start your next SaaS product with a modern Laravel foundation. Bring authentication, permissions, API resources, and an admin workspace together—so you can spend more time building features that matter.
                </p>

                <div class="mt-9 flex flex-col justify-center gap-3 sm:mt-10 sm:flex-row sm:gap-4">
                    @auth
                        <a href="/admin" class="group inline-flex min-h-14 items-center justify-center gap-3 rounded-2xl bg-gradient-to-r from-primary to-primary-hover px-7 py-4 text-base font-bold text-white shadow-xl shadow-primary/25 transition duration-200 hover:-translate-y-0.5 hover:shadow-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-slate-950 sm:px-9">
                            Open your dashboard
                            <svg class="size-5 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </a>
                    @else
                        <a href="/admin/login" class="group inline-flex min-h-14 items-center justify-center gap-3 rounded-2xl bg-gradient-to-r from-primary to-primary-hover px-7 py-4 text-base font-bold text-white shadow-xl shadow-primary/25 transition duration-200 hover:-translate-y-0.5 hover:shadow-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-slate-950 sm:px-9">
                            Get started
                            <svg class="size-5 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14m-6-6 6 6-6 6"/></svg>
                        </a>
                        <a href="#features" class="inline-flex min-h-14 items-center justify-center gap-2 rounded-2xl border border-white/20 bg-white/[0.06] px-7 py-4 text-base font-bold text-white backdrop-blur transition hover:border-white/35 hover:bg-white/[0.12] focus:outline-none focus-visible:ring-2 focus-visible:ring-white sm:px-9">Explore features</a>
                    @endauth
                </div>

                <div class="mt-12 border-t border-white/10 pt-7 sm:mt-16 sm:pt-8">
                    <p class="mb-4 text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Built with a modern Laravel stack</p>
                    <ul class="flex flex-wrap justify-center gap-2.5 sm:gap-3" aria-label="Technology stack">
                        @foreach(['Laravel 13+', 'MoonShine v4', 'Tailwind CSS 4', 'PHP 8.4+', 'Spatie packages', 'Laravel Restify'] as $tech)
                            <li class="rounded-xl border border-white/10 bg-white/[0.05] px-3.5 py-2 text-xs font-semibold text-slate-200 transition hover:border-white/20 hover:bg-white/10 sm:px-4 sm:text-sm">{{ $tech }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="scroll-mt-24 bg-gradient-to-b from-white to-slate-50 py-16 sm:py-24 lg:py-28" aria-labelledby="features-title">
        <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto mb-12 max-w-3xl text-center sm:mb-16">
                <p class="mb-3 text-sm font-bold uppercase tracking-[0.18em] text-primary">A stronger starting point</p>
                <h2 id="features-title" class="text-balance text-3xl font-black tracking-tight text-slate-950 sm:text-4xl lg:text-5xl">The essentials to build and grow</h2>
                <p class="mx-auto mt-5 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg sm:leading-8">Spend less time wiring up the basics. Start with a clear foundation for security, content, permissions, and APIs.</p>
            </div>

            @php
                $features = [
                    ['icon' => '🔒', 'title' => 'Security by design', 'desc' => 'CSP headers, CSRF protection, rate limiting, input validation, and policy-based authorization help establish safer defaults.', 'color' => 'from-blue-500 to-cyan-500'],
                    ['icon' => '🛡️', 'title' => 'Role-based permissions', 'desc' => 'Organize access for Admin, Editor, and Contributor roles with granular permissions managed through your admin workspace.', 'color' => 'from-purple-500 to-pink-500'],
                    ['icon' => '⚡', 'title' => 'Modern development stack', 'desc' => 'Build on Laravel, PHP, Vite, and Tailwind CSS 4 with a workflow designed to keep development clear and efficient.', 'color' => 'from-amber-500 to-orange-500'],
                    ['icon' => '🚀', 'title' => 'API-first architecture', 'desc' => 'Use Laravel Restify repositories to shape API responses and apply authorization and throttling to API operations.', 'color' => 'from-green-500 to-emerald-500'],
                    ['icon' => '🧾', 'title' => 'Activity and audit trails', 'desc' => 'Track important application activity with Spatie Activitylog to support visibility and operational review.', 'color' => 'from-red-500 to-rose-500'],
                    ['icon' => '🎨', 'title' => 'Admin experience', 'desc' => 'Manage your application through MoonShine with a responsive interface and a foundation you can extend to fit your workflow.', 'color' => 'from-indigo-500 to-violet-500'],
                ];
            @endphp

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 lg:gap-6">
                @foreach($features as $feature)
                    <article class="group relative isolate overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-slate-300 hover:shadow-xl hover:shadow-slate-900/[0.06] sm:p-8">
                        <div class="pointer-events-none absolute inset-0 -z-10 bg-gradient-to-br {{ $feature['color'] }} opacity-0 transition-opacity duration-300 group-hover:opacity-[0.06]" aria-hidden="true"></div>
                        <div class="mb-6 flex size-14 items-center justify-center rounded-2xl bg-slate-100 text-3xl transition duration-300 group-hover:scale-105 group-hover:bg-white group-hover:shadow-md" aria-hidden="true">{{ $feature['icon'] }}</div>
                        <h3 class="text-xl font-extrabold tracking-tight text-slate-950 sm:text-2xl">{{ $feature['title'] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600 sm:text-base">{{ $feature['desc'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    <section class="bg-slate-950 py-14 sm:py-20" aria-label="Platform requirements">
        <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4 sm:gap-6 lg:grid-cols-4">
                @foreach([['number' => '13+', 'label' => 'Laravel target'], ['number' => '8.4+', 'label' => 'PHP requirement'], ['number' => 'RBAC', 'label' => 'Permission model'], ['number' => 'API', 'label' => 'Restify powered']] as $stat)
                    <div class="rounded-2xl border border-white/10 bg-white/[0.04] p-5 text-center sm:p-7">
                        <p class="text-3xl font-black tracking-tight text-white sm:text-4xl">{{ $stat['number'] }}</p>
                        <p class="mt-2 text-xs font-semibold text-slate-400 sm:text-sm">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="relative isolate overflow-hidden bg-gradient-to-br from-primary via-primary-hover to-secondary py-16 sm:py-24 lg:py-28" aria-labelledby="cta-title">
        <div class="pointer-events-none absolute inset-0 -z-10 opacity-[0.10]" aria-hidden="true" style="background-image: radial-gradient(rgba(255,255,255,.9) 1px, transparent 1px); background-size: 22px 22px;"></div>
        <div class="mx-auto max-w-4xl px-4 text-center sm:px-6 lg:px-8">
            <p class="mb-4 text-sm font-bold uppercase tracking-[0.18em] text-white/75">Your next build starts here</p>
            <h2 id="cta-title" class="text-balance text-3xl font-black tracking-tight text-white sm:text-5xl lg:text-6xl">Ready to build your next idea?</h2>
            <p class="mx-auto mt-5 max-w-2xl text-base leading-7 text-white/85 sm:mt-6 sm:text-xl sm:leading-8">Start from a structured foundation and adapt it to your product, team, and customers.</p>
            @auth
                <a href="/admin" class="mt-8 inline-flex min-h-14 items-center justify-center gap-3 rounded-2xl bg-white px-7 py-4 text-base font-extrabold text-primary shadow-xl transition hover:-translate-y-0.5 hover:shadow-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-primary sm:px-9">Go to dashboard <span aria-hidden="true">→</span></a>
            @else
                <a href="/admin/login" class="mt-8 inline-flex min-h-14 items-center justify-center gap-3 rounded-2xl bg-white px-7 py-4 text-base font-extrabold text-primary shadow-xl transition hover:-translate-y-0.5 hover:shadow-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-offset-2 focus-visible:ring-offset-primary sm:px-9">Get started <span aria-hidden="true">→</span></a>
            @endauth
            <p class="mt-5 text-sm text-white/75">Explore the features, then sign in to access your workspace.</p>
        </div>
    </section>

    @auth
        <section class="bg-slate-50 py-12 sm:py-20" aria-labelledby="account-title">
            <div class="mx-auto max-w-screen-2xl px-4 sm:px-6 lg:px-8">
                <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-lg shadow-slate-900/[0.04]">
                    <div class="border-b border-slate-100 p-5 sm:p-8">
                        <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                            <img src="{{ Auth::user()->avatar_url }}" alt="Avatar for {{ Auth::user()->name }}" width="80" height="80" loading="lazy" decoding="async" class="size-16 rounded-2xl border border-slate-200 bg-slate-100 object-cover sm:size-20">
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-semibold text-primary">Your workspace</p>
                                <h2 id="account-title" class="mt-1 break-words text-2xl font-black tracking-tight text-slate-950 sm:text-3xl">{{ Auth::user()->name }}</h2>
                                <p class="mt-1 break-all text-sm text-slate-500">{{ Auth::user()->email }}</p>
                                @if(Auth::user()->roles->isNotEmpty())
                                    <div class="mt-3 flex flex-wrap gap-2" aria-label="Your roles">
                                        @foreach(Auth::user()->roles as $role)
                                            <span class="rounded-full bg-primary/10 px-3 py-1 text-xs font-bold text-primary">{{ ucfirst($role->name) }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <a href="/admin" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-slate-950 px-5 py-3 text-sm font-bold text-white transition hover:bg-slate-800 focus:outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">Open dashboard <span class="ml-2" aria-hidden="true">→</span></a>
                        </div>
                    </div>
                    <div class="grid gap-px bg-slate-100 sm:grid-cols-2 lg:grid-cols-3">
                        <a href="/admin" class="group bg-white p-6 transition hover:bg-slate-50 sm:p-7">
                            <span class="mb-4 flex size-12 items-center justify-center rounded-2xl bg-primary/10 text-2xl" aria-hidden="true">📊</span>
                            <span class="block text-lg font-extrabold text-slate-950">Admin dashboard</span>
                            <span class="mt-2 block text-sm leading-6 text-slate-600">Access the main workspace and manage your application.</span>
                            <span class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-primary">Open dashboard <span class="transition-transform group-hover:translate-x-1" aria-hidden="true">→</span></span>
                        </a>
                        <a href="/admin/resource/post-resource/post-index-page" class="group bg-white p-6 transition hover:bg-slate-50 sm:p-7">
                            <span class="mb-4 flex size-12 items-center justify-center rounded-2xl bg-purple-100 text-2xl" aria-hidden="true">✍️</span>
                            <span class="block text-lg font-extrabold text-slate-950">Manage content</span>
                            <span class="mt-2 block text-sm leading-6 text-slate-600">Create, review, and manage posts from your admin panel.</span>
                            <span class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-primary">Manage posts <span class="transition-transform group-hover:translate-x-1" aria-hidden="true">→</span></span>
                        </a>
                        <a href="/profile" class="group bg-white p-6 transition hover:bg-slate-50 sm:p-7">
                            <span class="mb-4 flex size-12 items-center justify-center rounded-2xl bg-slate-100 text-2xl" aria-hidden="true">⚙️</span>
                            <span class="block text-lg font-extrabold text-slate-950">Account settings</span>
                            <span class="mt-2 block text-sm leading-6 text-slate-600">Review your account details and available profile settings.</span>
                            <span class="mt-4 inline-flex items-center gap-2 text-sm font-bold text-primary">View settings <span class="transition-transform group-hover:translate-x-1" aria-hidden="true">→</span></span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endauth

    <footer class="border-t border-slate-200 bg-white py-7">
        <div class="mx-auto flex max-w-screen-2xl flex-col gap-3 px-4 text-center sm:flex-row sm:items-center sm:justify-between sm:px-6 sm:text-left lg:px-8">
            <p class="text-sm font-bold text-slate-800">PMD SaaS Starter</p>
            <p class="text-xs leading-5 text-slate-500">A modern Laravel foundation for secure, maintainable applications.</p>
        </div>
    </footer>
@endsection
