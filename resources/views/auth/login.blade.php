@extends('layouts.default-plain')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div>
                    <a href="/" title="{{env('AUTHOR_NAME')}}"><img src="" alt="{{env('AUTHOR_NAME')}}"></a>

                </div>
                <div>
                    We are always ready
                    for perfection
                </div>
                <div>
                    Lorem Ipsum is simply dummy text of the printing and
                    typesetting industry.
                </div>
            </div>
            <div class="col-md-8">
                <div>
                    <h3>Login your account</h3>
                    <h4>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h4>
                </div>
            </div>
                <div>
                    <input type="text">
                </div>
            </div>
        </div>
    </div>
@stop
