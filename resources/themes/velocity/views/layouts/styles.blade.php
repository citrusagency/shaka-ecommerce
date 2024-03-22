{{-- preloaded fonts --}}
<link rel="preload" href="{{ asset('themes/velocity/assets/fonts/font-rango/rango.ttf') . '?o0evyv' }}" as="font"
      crossorigin="anonymous"/>

{{-- bootstrap --}}
<link rel="stylesheet" href="{{ asset('themes/velocity/assets/css/bootstrap.min.css') }}"/>

{{-- bootstrap flipped for rtl --}}
@if (
    core()->getCurrentLocale()
    && core()->getCurrentLocale()->direction === 'rtl'
)
    <link href="{{ asset('themes/velocity/assets/css/bootstrap-flipped.css') }}" rel="stylesheet">
@endif

{{-- mix versioned compiled file --}}
<link rel="stylesheet" href="{{ asset(mix('/css/velocity.css', 'themes/velocity/assets')) }}"/>

{{-- extra css --}}
@stack('css')

{{-- custom css --}}
<style>
    {!! core()->getConfigData('general.content.custom_scripts.custom_css') !!}

    * {
        font-family: 'Open Sans', sans-serif;

    }

    p, a, button {
        font-size: 18px !important;
        line-height: 32px !important;
        font-family: "Outfit", sans-serif !important;
    }

    h1, h2, h3, h4, h5, h6 {
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    button {
        padding: 8px 22px;
        align-items: center;
        border-radius: 8px;
        background: #1197C2;
        color: #FFF;
        text-align: center;
        font: 600 16px normal;
        line-height: 22px;
        letter-spacing: 0.48px;
    }

    .login-input, textarea {
        border: transparent 0px !important;
        border-radius: 8px !important;
        padding: 1.5rem 1rem !important;
    }
    input, textarea::placeholder{
        -webkit-text-fill-color: black;
    }

    label {
        color: #777;
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-style: normal;
        font-weight: 700;
        line-height: 16px;
        letter-spacing: 0.7px;
        margin-bottom: 1rem;
    }

    .shaka-p {
        font-family: "Outfit", sans-serif;
        font-size: 18px;
        font-style: normal;
        color: #777777;
        font-weight: 300;
        line-height: 32px;
    }

    .shaka-checkbox {
        width: 20px;
        height: 20px;
        outline: none;
    }
</style>

