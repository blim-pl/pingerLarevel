@if ($errors->any())
    <div class="form-group">
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <span class="btn btn-danger">{{ $error }}</span>
            @endforeach
        </div>
    </div>
@endif