@extends('layouts.master')

@section('content')
    <main class="app-main">
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Car</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Car
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="app-content">
            <div class="container-fluid">
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline mb-4">
                            <div class="card-header">
                                <div class="card-title">Tạo mới</div>
                            </div>

                            <div class="card-body">
                                @if(\Session::has('msg'))
                                    <div class="alert alert-success">
                                        {{ \Session::get('msg') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <form action="{{ route('admin.cars.store') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control">

                                    <label for="brand_id">Brand</label>
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        @foreach($brands as $id => $name)
                                            <option value="{{ $id }}">{{ $id . ' - ' . $name }}</option>
                                        @endforeach
                                    </select>

                                    <label for="img_thumbnail">Img thumbnail</label>
                                    <input type="file" name="img_thumbnail" id="img_thumbnail" class="form-control">

                                    <label for="describe">Describe</label>
                                    <textarea name="describe" id="describe" class="form-control"></textarea>

                                    <br>

                                    <a href="{{ route('admin.cars.index') }}" class="btn btn-primary">Về trang
                                        list</a>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
