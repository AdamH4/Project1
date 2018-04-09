@if ($errors->any())
    <div class="alert alert-danger" id="flash-message">
        <ul>
            @foreach ($errors->all() as $message)
                <li>
                    {{ $message }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 5000); // <-- time in milliseconds
</script>