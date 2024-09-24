@extends('layout.app')

@section('styles')
    @parent
    {!! includes('clinica.styles-v2') !!}
@endsection

@section('scripts')
    @parent
    <script>
        var BASE_URL = "{{ base_url() }}";
        var BASE_PATH = "{{ asset('/') }}";
        var SITE_URL = "{{ site_url() }}";
        var SITE_KEY = "{{ env('INVISIBLE_RECAPTCHA_SITEKEY') }}";
    </script>
@endsection

@section('content')
    @include('layout.header')
    @include('layout.sidebar')

    <div id="page">
        <div class="main-content scroller">
            @yield('main')
        </div>
    </div>

    @include('layout.footer')
@endsection
