@if ($errors->any())
    <div class="alert alert-danger" id="flash-message">
        <ul>
            @foreach ($errors->all() as $error)
               {{ $error }}
            @endforeach
        </ul>
    </div>
@endif
<script>
    setTimeout(function() {
        $('#flash-message').fadeOut(1000);
    }, 3000); // <-- time in milliseconds
</script>