@if(config('simple-recaptcha-v3.active'))
    @if(config('simple-recaptcha-v3.hide_badge'))
        <style> .grecaptcha-badge { visibility: hidden; } </style>
    @endif
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('simple-recaptcha-v3.site_key') }}{{ (! config('simple-recaptcha-v3.prefer_navigator_language')) ? '&hl='.app()->getLocale() : '' }}"></script>
    <script type="application/javascript">
        function prepareCaptcha(action, id) {
            grecaptcha.ready(() => {
                grecaptcha.execute("{{ config('simple-recaptcha-v3.site_key') }}", {action: action}).then(function (token) {
                    var recaptchaResponse = document.getElementById(id)
                    recaptchaResponse.value = token
                    setInterval(() => { prepareCaptcha(action, id) }, 119000)
                })
            })
        }
    </script>
@endif
