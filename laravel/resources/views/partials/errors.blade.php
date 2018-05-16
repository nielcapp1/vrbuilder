<div id="error-modal" class="modal" aria-hidden="true">
    <div class="modal-content">
        <h1>Foutmelding</h1>
        <p>Gelieve onderstaande foutmeldingen na te zien:</p>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    <div class="modal-footer">
        <div class="btn-wrapper-center">
            <a class="modal-action modal-close btn-flat">Sluiten</a>
        </div>
    </div>
</div>

@if($errors->any())
    <script type="text/javascript">
    $(document).ready(function() {
        $('#error-modal').modal('open');
    });
    </script>
@endif