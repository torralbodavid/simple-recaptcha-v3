@if(config('simple-recaptcha-v3.active'))
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('simple-recaptcha-v3.site_key') }}"></script>
@endif
