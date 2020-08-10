@extends('layouts.app')

@section('content')


    <div class="container">
        <div class="card">
            <div class="card-header">{{ __('Invitations') }}</div>
            <div class="card-body">
                <form method="POST" action="{{ route('invitations.store') }}">
                    @csrf

                    <div class="form-group row mt-2">
                        <label for="email" class="col-md-2 col-sm-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                        <div class="col-md-8 col-sm-6">
                            <input id="email" type="email" class="form-control mb-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-2 col-sm-4 ">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Add') }}
                            </button>
                        </div>
                    </div>
                </form>

                @if (!$invitations->isEmpty())
                    <div class="row horizontal-scroll-container">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Email</th>
                                        <th scope="col">Invite link</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invitations as $invitation)
                                        <tr>
                                            <td>{{ $invitation->email }}</td>
                                            <td>
                                                <div class="d-flex align-content-center justify-content-lg-between" >
                                                    <div id="invite_{{ $invitation->token }}">{{ route('register') }}?token={{ $invitation->token }}</div>
                                                    <button type="button" class="btn btn-success" data-clipboard-target="#invite_{{ $invitation->token }}">
                                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-clipboard" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                                            <path fill-rule="evenodd" d="M9.5 1h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

        </div>
    </div>
@endsection


