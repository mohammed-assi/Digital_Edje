@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Update user</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <form method="post" action="{{ route('users.update', $user->id) }}">
                @method('patch')
                @csrf
                
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ $user->email }}"
                        type="email" 
                        class="form-control" 
                        name="email" 
                        placeholder="Email address" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="FirstName" class="form-label">FirstName</label>
                    <input value="{{ $user->FirstName }}"
                        type="text" 
                        class="form-control" 
                        name="FirstName" 
                        placeholder="FirstName" required>
                    @if ($errors->has('FirstName'))
                        <span class="text-danger text-left">{{ $errors->first('FirstName') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="LastName" class="form-label">LastName</label>
                    <input value="{{ $user->LastName }}"
                        type="text" 
                        class="form-control" 
                        name="LastName" 
                        placeholder="LastName" required>
                    @if ($errors->has('LastName'))
                        <span class="text-danger text-left">{{ $errors->first('LastName') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input value="{{ $user->phone }}"
                        type="text" 
                        class="form-control" 
                        name="phone" 
                        placeholder="phone" required>
                    @if ($errors->has('phone'))
                        <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                    @endif
                </div>

                {{-- <div class="mb-3">
                    <label for="password" class="form-label">password</label>
                    <input value="{{ $user->password }}" 
                        type="text" 
                        class="form-control" 
                        name="password" 
                        placeholder="password" required>

                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div> --}}

                <button type="submit" class="btn btn-primary">Update user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
            </form>
        </div>

    </div>
@endsection
