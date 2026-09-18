<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crear cuenta | NutriAdmin</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, Arial, sans-serif;
            color: #eff7f1;
            background:
                radial-gradient(
                    circle at 15% 20%,
                    rgba(109, 175, 112, .18),
                    transparent 30%
                ),
                radial-gradient(
                    circle at 90% 80%,
                    rgba(184, 219, 135, .10),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #06140d,
                    #092116 55%,
                    #06150e
                );
        }

        .register-page {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            overflow: hidden;
        }

        /* Decoraciones */
        .register-page::before {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            top: -260px;
            left: -180px;
            border-radius: 50%;
            background: rgba(139, 197, 131, .08);
            filter: blur(10px);
        }

        .register-page::after {
            content: "";
            position: absolute;
            width: 500px;
            height: 500px;
            bottom: -300px;
            right: -180px;
            border-radius: 50%;
            background: rgba(208, 229, 114, .07);
        }

        .register-wrapper {
            position: relative;
            z-index: 2;

            width: min(1100px, 100%);

            display: grid;
            grid-template-columns: 1fr 1fr;

            overflow: hidden;

            border:
                1px solid rgba(255, 255, 255, .10);

            border-radius: 30px;

            background:
                rgba(8, 28, 18, .72);

            backdrop-filter: blur(24px);

            box-shadow:
                0 35px 90px rgba(0, 0, 0, .35);
        }

        /* =========================================
           IZQUIERDA
        ========================================= */

        .register-info {
            position: relative;
            padding: 55px;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            background:
                radial-gradient(
                    circle at 20% 20%,
                    rgba(150, 201, 143, .16),
                    transparent 35%
                ),
                linear-gradient(
                    145deg,
                    rgba(21, 67, 45, .72),
                    rgba(6, 27, 17, .85)
                );
        }

        .register-logo {
            display: flex;
            align-items: center;
            gap: 12px;

            color: white;
            text-decoration: none;

            font-size: 23px;
            font-weight: 800;
        }

        .register-logo-icon {
            width: 46px;
            height: 46px;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background:
                linear-gradient(
                    135deg,
                    #c4e9b8,
                    #82b68a
                );

            color: #10351e;
        }

        .register-logo-icon svg {
            width: 24px;
            height: 24px;
        }

        .register-logo span {
            color: #aad29f;
        }

        .register-info-content {
            margin: 70px 0;
        }

        .register-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;

            margin-bottom: 22px;

            padding: 8px 13px;

            border:
                1px solid rgba(170, 211, 161, .20);

            border-radius: 30px;

            background:
                rgba(165, 208, 157, .08);

            color: #b3d7ac;

            font-size: 11px;
        }

        .register-info h1 {
            max-width: 470px;

            margin: 0 0 20px;

            font-size:
                clamp(
                    38px,
                    5vw,
                    57px
                );

            line-height: 1.02;

            letter-spacing: -2px;
        }

        .register-info h1 span {
            display: block;

            background:
                linear-gradient(
                    90deg,
                    #abd5a3,
                    #dbe978
                );

            -webkit-background-clip: text;
            background-clip: text;

            color: transparent;
        }

        .register-info-description {
            max-width: 470px;

            margin: 0;

            color:
                rgba(225, 239, 227, .58);

            font-size: 14px;
            line-height: 1.8;
        }

        .register-benefits {
            display: flex;
            flex-direction: column;
            gap: 13px;

            margin-top: 30px;
        }

        .register-benefit {
            display: flex;
            align-items: center;
            gap: 11px;

            color:
                rgba(233, 244, 235, .72);

            font-size: 12px;
        }

        .benefit-check {
            width: 27px;
            height: 27px;

            display: flex;
            align-items: center;
            justify-content: center;

            flex-shrink: 0;

            border-radius: 50%;

            background:
                rgba(171, 212, 161, .12);

            color: #b9dfa9;

            font-size: 12px;
        }

        .register-info-footer {
            color:
                rgba(220, 235, 223, .35);

            font-size: 10px;
        }

        /* =========================================
           FORMULARIO
        ========================================= */

        .register-form-side {
            padding: 50px 55px;

            background:
                rgba(7, 22, 14, .82);
        }

        .form-heading {
            margin-bottom: 30px;
        }

        .form-heading span {
            display: block;

            margin-bottom: 8px;

            color: #98c393;

            font-size: 10px;
            font-weight: 700;

            letter-spacing: 2px;
        }

        .form-heading h2 {
            margin: 0 0 9px;

            color: #f2f9f3;

            font-size: 28px;

            letter-spacing: -1px;
        }

        .form-heading p {
            margin: 0;

            color:
                rgba(219, 234, 222, .46);

            font-size: 12px;
            line-height: 1.6;
        }

        /* CAMPOS */

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;

            margin-bottom: 8px;

            color:
                rgba(230, 241, 232, .72);

            font-size: 11px;
            font-weight: 600;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;

            top: 50%;
            left: 16px;

            transform: translateY(-50%);

            width: 18px;
            height: 18px;

            color:
                rgba(169, 207, 162, .55);
        }

        .form-input {
            width: 100%;
            height: 52px;

            padding:
                0 15px
                0 48px;

            border:
                1px solid rgba(255, 255, 255, .09);

            border-radius: 14px;

            outline: none;

            background:
                rgba(255, 255, 255, .035);

            color: #f4faf5;

            font-size: 12px;

            transition: .2s;
        }

        .form-input::placeholder {
            color:
                rgba(221, 235, 224, .25);
        }

        .form-input:focus {
            border-color:
                rgba(163, 209, 153, .45);

            background:
                rgba(156, 204, 148, .06);

            box-shadow:
                0 0 0 4px
                rgba(148, 199, 139, .06);
        }

        /* ERRORES */

        .form-error {
            margin-top: 7px;

            color: #e99a9a;

            font-size: 10px;
        }

        /* BOTÓN */

        .register-button {
            width: 100%;
            min-height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;

            margin-top: 24px;

            border: none;
            border-radius: 14px;

            cursor: pointer;

            background:
                linear-gradient(
                    135deg,
                    #aed6a4,
                    #dce970
                );

            color: #102417;

            font-size: 12px;
            font-weight: 800;

            box-shadow:
                0 15px 40px
                rgba(142, 188, 122, .17);

            transition: .2s;
        }

        .register-button:hover {
            transform: translateY(-2px);

            box-shadow:
                0 20px 50px
                rgba(142, 188, 122, .25);
        }

        .register-button svg {
            width: 15px;
            height: 15px;
        }

        /* LOGIN */

        .login-text {
            margin-top: 22px;

            text-align: center;

            color:
                rgba(220, 235, 223, .43);

            font-size: 11px;
        }

        .login-text a {
            color: #afd4a7;

            font-weight: 700;

            text-decoration: none;
        }

        .login-text a:hover {
            color: #dce979;
        }

        .register-security {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 7px;

            margin-top: 25px;

            color:
                rgba(216, 231, 219, .25);

            font-size: 9px;
        }

        .register-security svg {
            width: 12px;
            height: 12px;
        }

        /* =========================================
           RESPONSIVE
        ========================================= */

        @media(max-width: 850px) {

            .register-wrapper {
                grid-template-columns: 1fr;
                max-width: 600px;
            }

            .register-info {
                padding: 40px;
            }

            .register-info-content {
                margin: 45px 0;
            }

            .register-info h1 {
                font-size: 42px;
            }

            .register-form-side {
                padding: 40px;
            }
        }

        @media(max-width: 500px) {

            .register-page {
                padding: 15px;
            }

            .register-wrapper {
                border-radius: 22px;
            }

            .register-info {
                padding: 30px 24px;
            }

            .register-form-side {
                padding: 32px 24px;
            }

            .register-info h1 {
                font-size: 36px;
            }
        }

    </style>
</head>


<body>

<div class="register-page">

    <div class="register-wrapper">

        {{-- ==========================================
             PANEL IZQUIERDO
        =========================================== --}}
        <section class="register-info">

            <a
                href="{{ url('/') }}"
                class="register-logo"
            >

                <div class="register-logo-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="currentColor"
                    >
                        <path d="M20.8 3.2C14.8 3.3 8.3 5.5 5.1 10.4c-2.6 4-1.7 7.5-1.7 7.5s3.5.9 7.5-1.7c4.9-3.2 7.1-9.7 7.2-15.7-1.7 2.6-4.1 4.8-7 6.4-2.2 1.2-4.1 2.7-5.5 4.7 1.1-2.8 3.1-5.2 5.7-6.8 2.8-1.8 6.1-2.7 9.5-2.7z"/>
                    </svg>

                </div>

                Nutri<span>Admin</span>

            </a>


            <div class="register-info-content">

                <div class="register-badge">
                    🌿 Plataforma para profesionales de la nutrición
                </div>

                <h1>
                    Empieza a gestionar
                    <span>tu consulta.</span>
                </h1>

                <p class="register-info-description">
                    Organiza pacientes, citas, evaluaciones,
                    progreso y pagos desde una sola plataforma
                    diseñada para profesionales de la nutrición.
                </p>


                <div class="register-benefits">

                    <div class="register-benefit">

                        <div class="benefit-check">
                            ✓
                        </div>

                        7 días de prueba gratuita

                    </div>


                    <div class="register-benefit">

                        <div class="benefit-check">
                            ✓
                        </div>

                        Sin tarjeta de crédito

                    </div>


                    <div class="register-benefit">

                        <div class="benefit-check">
                            ✓
                        </div>

                        Tu información centralizada

                    </div>

                </div>

            </div>


            <div class="register-info-footer">
                © {{ date('Y') }} NutriAdmin · Gestión para nutriólogos
            </div>

        </section>



        {{-- ==========================================
             FORMULARIO
        =========================================== --}}
        <section class="register-form-side">

            <div class="form-heading">

                <span>
                    CREA TU CUENTA
                </span>

                <h2>
                    Comienza gratis.
                </h2>

                <p>
                    Crea tu espacio de trabajo y comienza
                    a organizar tu consulta.
                </p>

            </div>


            <form
                method="POST"
                action="{{ route('register') }}"
            >

                @csrf


                {{-- NOMBRE --}}
                <div class="form-group">

                    <label
                        class="form-label"
                        for="name"
                    >
                        Nombre completo
                    </label>

                    <div class="input-wrapper">

                        <svg
                            class="input-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M20 21a8 8 0 0 0-16 0"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>

                        <input
                            id="name"
                            class="form-input"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Ej. Andrea López"
                        >

                    </div>

                    @error('name')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>



                {{-- EMAIL --}}
                <div class="form-group">

                    <label
                        class="form-label"
                        for="email"
                    >
                        Correo electrónico
                    </label>

                    <div class="input-wrapper">

                        <svg
                            class="input-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <rect
                                x="3"
                                y="5"
                                width="18"
                                height="14"
                                rx="2"
                            />

                            <path d="m3 7 9 6 9-6"/>
                        </svg>

                        <input
                            id="email"
                            class="form-input"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="correo@ejemplo.com"
                        >

                    </div>

                    @error('email')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>



                {{-- PASSWORD --}}
                <div class="form-group">

                    <label
                        class="form-label"
                        for="password"
                    >
                        Contraseña
                    </label>

                    <div class="input-wrapper">

                        <svg
                            class="input-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <rect
                                x="5"
                                y="10"
                                width="14"
                                height="10"
                                rx="2"
                            />

                            <path d="M8 10V7a4 4 0 0 1 8 0v3"/>
                        </svg>

                        <input
                            id="password"
                            class="form-input"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Mínimo 8 caracteres"
                        >

                    </div>

                    @error('password')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>



                {{-- CONFIRMAR PASSWORD --}}
                <div class="form-group">

                    <label
                        class="form-label"
                        for="password_confirmation"
                    >
                        Confirmar contraseña
                    </label>

                    <div class="input-wrapper">

                        <svg
                            class="input-icon"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path d="M20 6 9 17l-5-5"/>
                        </svg>

                        <input
                            id="password_confirmation"
                            class="form-input"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Repite tu contraseña"
                        >

                    </div>

                    @error('password_confirmation')
                        <div class="form-error">
                            {{ $message }}
                        </div>
                    @enderror

                </div>



                {{-- BOTÓN --}}
                <button
                    type="submit"
                    class="register-button"
                >

                    Crear mi cuenta

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path d="M5 12h14"/>
                        <path d="m13 6 6 6-6 6"/>
                    </svg>

                </button>


                <div class="login-text">

                    ¿Ya tienes una cuenta?

                    <a href="{{ route('login') }}">
                        Inicia sesión
                    </a>

                </div>


                <div class="register-security">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                    </svg>

                    Tus datos están protegidos

                </div>

            </form>

        </section>

    </div>

</div>

</body>
</html>