@extends('email.auth.main')
@section('title', trans('auth.email.register'))
@section('content')
    <div class="center_block" style="padding-bottom: 100px;">
        <h1>Welcome, {{ $name }}</h1>

        <h3>We're excited to have you get started! First you need to confirm your account. Just click the button
            below.</h3>

        <a href="{{ $url }}" class="btn d_block">Confirm Your Account</a>
    </div>

    <small>If you have any questions. Please feel free to inform - We're always ready to help out.</small>

    <p>Cheers,</p>
    <p>{{ config('app.name') }}</p>
@endsection
