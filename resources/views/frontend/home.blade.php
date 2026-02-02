@extends('frontend.layouts.app')

@section('content')
<section class="relative overflow-hidden min-h-[520px]">

    {{-- baground desktop --}}
    <div
        class="absolute inset-0 hidden lg:block z-0"
        style="
            background-image: url('{{ asset('images/kambing.png') }}');
            background-size: 120%;
            background-position: calc(30% + 120px) 25%;
            background-repeat: no-repeat;
        ">
    </div>

    {{-- baground mobile --}}
    <div class="absolute inset-0 bg-green-900 lg:hidden z-10"></div>

    {{-- gradasi desktop --}}
    <div class="absolute inset-0 hidden lg:block z-10
        bg-gradient-to-r
        from-green-900
        via-green-800/80
        to-green-400/50">
    </div>

    {{-- garis --}}
    <div class="absolute bottom-16 left-1/2 -translate-x-1/2
                flex items-center gap-6 z-20
                w-full max-w-xs md:max-w-md lg:max-w-xl px-6">
        
        <div class="flex-1 h-px bg-white/40"></div>
        <div class="flex-1 h-px bg-white/40"></div>

    </div>

    <div class="relative z-20 max-w-7xl mx-auto
                grid grid-cols-1 lg:grid-cols-2
                px-6 min-h-[520px]">

        <div class="flex flex-col justify-center
                    text-white text-center lg:text-left">

            <h1 class="text-3xl lg:text-4xl font-bold leading-tight">
                SELAMAT DATANG <br>
                BHAKTI BUMI SUKOWATI
            </h1>

            <p class="mt-4 text-base lg:text-lg
                      max-w-md mx-auto lg:mx-0">
                Menyediakan Produk Olahan Pertanian Lokal dan
                cemilan BBS sebagai oleh oleh
            </p>

            <div class="mt-6 flex justify-center lg:justify-start">
                <button
                    class="inline-flex items-center gap-2
                           bg-yellow-400 text-gray-900
                           px-5 py-2.5
                           text-sm font-semibold
                           rounded-md
                           hover:bg-yellow-300
                           transition">

                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 24 24"
                         stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386a.75.75 0 01.728.588L5.94 9.75m0 0h11.32a.75.75 0 01.728.972l-1.5 6a.75.75 0 01-.728.528H7.125a.75.75 0 01-.728-.528l-1.5-6z"/>
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 20.25a.75.75 0 11-1.5 0
                                 .75.75 0 011.5 0zm6 0a.75.75 0 11-1.5 0
                                 .75.75 0 011.5 0z"/>
                    </svg>

                    Produk Kami
                </button>
            </div>

        </div>

        <div class="hidden lg:block"></div>

    </div>
</section>
@endsection
