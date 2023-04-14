@extends('layouts.app-master')

@section('content')
    <div class="bg-light p-4 rounded">
        <h1>Show product</h1>
        <div class="lead">
            
        </div>
        
        <div class="container mt-4">
            <div>
                Name: {{ $product->name }}
            </div>
            <div>
                description: {{ $product->description }}
            </div>
            <div >
                <div> image:</div>
                <div>  <img src="/storage/{{ $product->image }}" 
                class="w-50" /></div>
            </div>
        </div>

    </div>
    <div class="mt-4">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Edit</a>
        <a href="{{ route('products.index') }}" class="btn btn-default">Back</a>
    </div>
@endsection
