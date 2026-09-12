<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'NutriAdmin')
    </title>

    <meta
        name="description"
        content="NutriAdmin te ayuda a gestionar pacientes, citas, progreso, pagos y planes nutricionales desde un solo lugar."
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/landing.css') }}"
    >

</head>


<body>


    {{-- ============================================
         NAVBAR
    ============================================= --}}

    <nav class="landing-navbar">

        <div class="landing-container navbar-content">


            {{-- LOGO --}}

            <a
                href="{{ route('landing') }}"
                class="landing-logo"
            >

                <div class="landing-logo-icon">

                    <i class="fas fa-leaf"></i>

                </div>

                <span>
                    Nutri<span>Admin</span>
                </span>

            </a>



            {{-- LINKS --}}

            <div
                class="landing-nav-links"
                id="landingNav"
            >

                <a href="#inicio">
                    Inicio
                </a>

                <a href="#funciones">
                    Funciones
                </a>

                <a href="#como-funciona">
                    Cómo funciona
                </a>

                <a href="#planes">
                    Planes
                </a>

                <a href="#faq">
                    FAQ
                </a>

            </div>



            {{-- ACCIONES --}}

            <div class="landing-nav-actions">

                @auth

                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-login"
                    >
                        Ir al panel
                    </a>

                @else

                    <a
                        href="{{ route('login') }}"
                        class="nav-login"
                    >
                        Iniciar sesión
                    </a>


                    <a
                        href="{{ route('register') }}"
                        class="nav-trial"
                    >

                        Prueba gratis

                        <i class="fas fa-arrow-right"></i>

                    </a>

                @endauth

            </div>



            {{-- MÓVIL --}}

            <button
                class="mobile-menu-button"
                id="mobileMenuButton"
                type="button"
            >

                <i class="fas fa-bars"></i>

            </button>


        </div>

    </nav>



    {{-- CONTENIDO --}}

    <main>

        @yield('content')

    </main>



    <script>

        const menuButton =
            document.getElementById('mobileMenuButton');

        const nav =
            document.getElementById('landingNav');


        menuButton?.addEventListener(
            'click',
            function () {

                nav.classList.toggle('active');

            }
        );


        window.addEventListener(
            'scroll',
            function () {

                const navbar =
                    document.querySelector('.landing-navbar');

                navbar.classList.toggle(
                    'scrolled',
                    window.scrollY > 20
                );

            }
        );

    </script>


    @yield('js')

</body>

</html>