@extends('backend.layouts.app', ['activePage' => 'courses', 'title' => 'Add Category', 'navName' => 'coursecategories', 'activeButton' => 'catalogue'])

@section('content')
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link"
                                href="{{ route('backend.courses.categories.list') }}">Categories</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Category</li>
                    </ol>
                </nav>
                <h1 class="page-header-title">Add Category</h1>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>

    <form action="{{ route('backend.courses.categories.store') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title mb-0">Category information</h4>
                    </div>
                    <!-- End Header -->
                    <div class="card-body">
                        @include('includes.validation-form')
                        <div class="mb-4">
                            <label for="CategoryNameLabel" class="form-label">Name </label>
                            <input type="text" name="name" id="CategoryNameLabel" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

@endsection

@section('js_content')
@endsection
