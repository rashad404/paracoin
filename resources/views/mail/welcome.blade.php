<h1>Verify your e-mail to finish signing up for {{env('APP_NAME')}}</h1>

<div>Thank you for choosing {{env('APP_NAME')}}</div>

<div>Please confirm that, {{$data['email']}} is your e-mail address by clicking on the button bellow or use this link
    <a target="_blank" href="{{env('APP_URL')}}/confirm-email/{{$data['code']}}">{{env('APP_URL')}}/confirm-email/{{$data['code']}}</a>
    within 48 hours.
</div>