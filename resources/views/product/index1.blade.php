@extends('layouts.app-master')

@section('content')
    

    <div class="bg-light p-4 rounded">
        <h1>Products</h1>
        <div class="lead">
            Manage your products here.
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right">Add new products</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.partials.messages')
        </div>

            <div class="text-center container py-5">
              @foreach($products as $product)

              <section style="background-color: #eee;">

              <div class="row">
                <div class="row justify-content-center mb-3">
                  <div class="col-md-12 col-xl-10">
                    <div class="card shadow-0 border rounded-3">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                            <div class="bg-image hover-zoom ripple rounded ripple-surface">
                              <img src="/storage/{{ $product->image }}" 
                                class="w-100" />
                              <a href="#!">
                                <div class="hover-overlay">
                                  <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                </div>
                              </a>
                            </div>
                          </div>
                          <div class="col-md-6 col-lg-6 col-xl-6">
                            <h5>{{ $product->name }}</h5>
             
                            <p class="text-truncate mb-4 mb-md-0">
                              {{ $product->description }}
                            </p>
                          </div>
                          <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                            
                            <div class="d-flex flex-column mt-4">
                              <tbody>
                                <tr><a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm">Show</a></tr>
                                <tr> </tr>
                                <tr><a href="{{ route('products.edit', $product->id) }}" class="btn btn-info btn-sm">Edit</a></tr>
                                <tr>
                                  {!! Form::open(['method' => 'DELETE','route' => ['products.destroy', $product->id],'style'=>'display:inline']) !!}
                                  {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                  {!! Form::close() !!} 
                                </tr>
                              </tbody>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
        </section>
        @endforeach

        <div class="d-flex">
            {{-- {!! $users->links() !!} --}}
        </div>

    </div>
@endsection
