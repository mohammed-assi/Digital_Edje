@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Update product</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @method('patch')
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
                    <label for="name" class="form-label">Email</label>
                    <input value="{{ $product->name }}"
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Name Product" required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">description</label>
                    <input value="{{ $product->description }}"
                        type="text" 
                        class="form-control" 
                        name="description" 
                        placeholder="description" required>
                    @if ($errors->has('description'))
                        <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">image</label>
                    <input value="{{ $product->image }}"
                        type="file" 
                        class="form-control" 
                        name="image" 
                        placeholder="image" required>
                    @if ($errors->has('image'))
                        <span class="text-danger text-left">{{ $errors->first('image') }}</span>
                    @endif
                </div>

               

                <button type="submit" class="btn btn-primary">Update user</button>
               <button> <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</button>
            </form>
        </div>

    </div>
@endsection
