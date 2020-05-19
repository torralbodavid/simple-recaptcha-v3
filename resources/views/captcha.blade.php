@if(config('simple-recaptcha-v3.active'))
    @php $id = app('simple-recaptcha-v3')->generateId() @endphp
    <input type="hidden" name="recaptcha_response" id="{{ $id }}">
    <script type="application/javascript">
        prepareCaptcha('{{ $action }}', '{{ $id }}')
    </script>
@endif
