@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Add new Product</h1>
       

        <div class="container mt-4">
            <form method="POST" action="{{ route('products.store')}}" enctype="multipart/form-data">
                @csrf
                <div>
                    <label>	users </label> 
                    <select  name="user_id" id="user_id" value="{{old('user_id')}}">
                        <option value="">-- Select user --</option>
                        @foreach ($users as $data)
                            <option value="{{$data->id}}">
                                    {{$data->FirstName . $data->LastName}}
                            </option>
                        @endforeach
                    </select>
                </div><br>

                <div class="mb-3">
                    <label for="name" class="form-label">name</label>
                    <input 
                        type="name" 
                        class="form-control" 
                        name="name" 
                        placeholder="name" required>
                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input 
                        type="description" 
                        class="form-control" 
                        name="description" 
                        placeholder="description" required>
                    @if ($errors->has('description'))
                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">image</label>
                    <input
                        type="file" 
                        class="form-control" 
                        name="image" 
                        placeholder="image" required>
                    @if ($errors->has('image'))
                        <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                    @endif
                </div>

                
                    @if ($errors->has('password'))
                        <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Save user</button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
            </form>
        </div>

    </div>
@endsection
