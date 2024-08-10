@extends('mail.layout')

@section('message')
    <p style="margin-bottom:15px">
        Hi {{ $user->first_name }} {{ $user->last_name }}
    </p>

    <p style="margin-bottom:5px">
        We have received your request to reset the password for your account.
        No changes will be made to your account yet,
        copy the code below in other to reset your password.
    </p>

    <div class="text-center" style="margin-top:15px; margin-bottom:15px;">
        <h1 style="font-size:100px !important; color:#000000 font-weight:800">{{ $code }}</h1>
    </div>

    <p style="margin-bottom:40px">
        If you did not make this request, please let us know as
        soon as possible by replying to this email or find answers at
        <a href="feranmi.com/faq" class="text-primary">feranmi.com/faq</a>
        for any other support.
    </p>

    <p>
        Feranmi Support Team
    </p>
@endsection
