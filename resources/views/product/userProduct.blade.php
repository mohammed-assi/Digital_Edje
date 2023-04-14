@extends('layouts.app-master')

@section('content')
    

    <div class="bg-light p-4 rounded">
        <h1>Products {{$user->FirstName . " ". $user->LastName}}</h1>
        <div class="lead">
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right">Add new products</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%"> Name</th>
                <th scope="col" width="15%"> Description</th>
                <th scope="col">image</th>
                <th scope="col" width="1%" colspan="3"></th>    
            </tr>
            </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <th scope="row">{{ $product->id }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td><img src="/storage/{{ $product->image }}" /></td>
                    <td><a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm">Show</a></td>
                    <td><a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Edit</a></td>
                    <td>
                        <form method="post" action="{{ route('products.destroy',$user->id) }}"> 
                            @csrf
                            @method('DELETE')
                            <button type="submit" class='btn btn-danger btn-sm'>delete</button>
                        </form>
                        {{-- {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $product->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}  --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

        <div class="d-flex">
            {{-- {!! $users->links() !!} --}}
        </div>

    </div>
@endsection
