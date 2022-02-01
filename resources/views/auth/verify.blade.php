@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifica tu Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un link de verificacion fue enviado a tu Email') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder, por favor verifica tu email.') }}
                    {{ __('Si no recivio el Email') }}, <a href="{{ route('verification.resend') }}">{{ __('click aqui para enviarlo nuevamente') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
