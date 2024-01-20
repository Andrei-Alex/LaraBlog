@extends('base')

@section('content')
    <h2>Connection</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{route('auth.login')}}" method="post" class="vstack gap-3">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email"
                           name="email"
                           class="form-control"
                           id="email"
                           value="{{old('email')}}">
                    @error('email')
                    {{$message}}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password"
                           name="password"
                           class="form-control"
                           id="password">
                    @error('password')
                    {{$message}}
                    @enderror
                </div>
                <button class="btn btn-primary">Connection</button>
            </form>
        </div>
    </div>
@endsection
