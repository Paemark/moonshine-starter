@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <div class="text-center py-16">
        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl md:text-6xl">
            Welcome to <span class="text-primary">Our Platform</span>
        </h1>
        <p class="mt-6 max-w-2xl mx-auto text-lg text-slate-600">
            A secure, scalable, and modern enterprise application built with Laravel 13+, MoonShine, and Tailwind CSS 4.
        </p>
        
        <div class="mt-10 flex justify-center gap-4">
            @auth
                <a href="/admin" class="px-8 py-3 text-base font-medium text-white bg-primary rounded-lg hover:bg-primary-hover transition-colors shadow-sm">
                    Go to Dashboard
                </a>
            @else
                <a href="/admin/login" class="px-8 py-3 text-base font-medium text-white bg-primary rounded-lg hover:bg-primary-hover transition-colors shadow-sm">
                    Get Started
                </a>
                <a href="/admin/login" class="px-8 py-3 text-base font-medium text-slate-700 bg-slate-100 rounded-lg hover:bg-slate-200 transition-colors">
                    Log In
                </a>
            @endauth
        </div>
    </div>
@endsection
