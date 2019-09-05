@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifier votre adresse mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Un lien de validation a ete envoye a votre adresse mail') }}
                        </div>
                    @endif

                    {{ __('Aavnt toute chose, veuillez verifier votre adresse mail.') }}
                    {{ __('Si vous n\'avez pas recu votre mail,') }}, <a href="{{ route('verification.resend') }}">{{ __('cliquez ici pour en avoir un nouveau.') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
