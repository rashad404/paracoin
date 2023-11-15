@if ($errors->any())
    <div class="alert {{$errors->has('success') ? 'alert-success':'alert-danger'}}">
        @foreach ($errors->all() as $error)
        <div>{!!$error!!}</div>
        @endforeach
    </div>
@endif
