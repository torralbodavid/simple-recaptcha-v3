@if(config('simple-recaptcha-v3.active'))
    <input type="hidden" name="recaptcha_response">
    <script type="application/javascript">
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ config('simple-recaptcha-v3.site_key') }}", {action: 'gromenauer'}).then(function (token) {
                let recaptchaResponse = document.getElementsByName('recaptcha_response')[0]
                recaptchaResponse.value = token
            })
        });
    </script>
@endif
