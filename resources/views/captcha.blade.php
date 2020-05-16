@if(config('simple-recaptcha-v3.active'))
    <input type="hidden" name="recaptcha_response">
    <script type="application/javascript">
        window.onload = function() {
            let form = document.getElementsByName("recaptcha_response")[0].closest('form')
            prepareCaptcha({{ $action }}, form)
        }
    </script>
@endif
