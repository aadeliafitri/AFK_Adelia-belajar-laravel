@extends('layouts.main')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  {{-- <div class="content-wrapper"> --}}
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Products</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('products') }}">Products</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header d-flex justify-content-end">
                <h3 class="card-title col align-self-center">Edit Products</h3>
              </div>
              <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger bg-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="product_code">Product Code</label>
                        <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Product Code" value="{{ $product->product_code }}">
                    </div>
                    <div class="form-group">
                        <label for="product_name">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Product Name" value="{{ $product->product_name }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description Product</label>
                        <textarea class="form-control" id="description" rows="3" name="description" placeholder="Describe Your Product">{{ $product->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="form-control ">
                        <option>Choose Category</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}" {{ $product->category_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="price">Price</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="price" id="price" class="form-control" value="{{ $product->price }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="discount_amount">Discount</label>
                                <div class="input-group mb-3">
                                    <input type="number" name="discount_amount" id="discount_amount" class="form-control" value="{{ $product->discount_amount }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock" value="{{ $product->stock }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" id="unit" name="unit" placeholder="Unit" value="{{ $product->unit }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-9">
                            <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="images[]" multiple>
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                            <label for="toogleActive">Active</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_active" name="is_active"
                                {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                                <label class="custom-control-label" for="is_active"><small>yes</small></label>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <button type="submit" class="btn btn-primary">Save</button>
              </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  {{-- </div> --}}
  <!-- /.content-wrapper -->
@endsection
