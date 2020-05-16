@if(config('simple-recaptcha-v3.active'))
    @if(config('simple-recaptcha-v3.hide_badge'))
        <style> .grecaptcha-badge { visibility: hidden; } </style>
    @endif
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('simple-recaptcha-v3.site_key') }}{{ (! config('simple-recaptcha-v3.prefer_navigator_language')) ? '&hl='.app()->getLocale() : '' }}"></script>
    <script type="application/javascript">
        function prepareCaptcha(action, form) {
            grecaptcha.ready(() => {
                grecaptcha.execute("{{ config('simple-recaptcha-v3.site_key') }}", {action: action}).then(function (token) {
                    let recaptchaResponse = form.elements['recaptcha_response']
                    recaptchaResponse.value = token
                })
            })
            setInterval(() => { prepareCaptcha(action, form) }, 119000)
        }
    </script>
@endif
