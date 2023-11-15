<h1>{{env('APP_NAME')}} password reset</h1>

<div>We received a request to reset your {{env('APP_NAME')}} password. Click the link below within 48 hours to choose a new one:</div>

<div><a target="_blank" href="{{env('APP_URL')}}/confirm-email/{{$data['token']}}">Reset Your Password</a></div>

<div>If you did not request a change of password, please ignore this e-mail</div>
