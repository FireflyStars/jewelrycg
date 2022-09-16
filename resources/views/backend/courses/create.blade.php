@extends('backend.layouts.app', ['activePage' => 'courses', 'title' => 'Add Course', 'navName' => 'allcourses', 'activeButton' => 'catalogue'])

@section('content')
    <div class="page-header mb-4">
        <div class="row align-items-center">
            <div class="col-sm mb-2 mb-sm-0">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-no-gutter">
                        <li class="breadcrumb-item"><a class="breadcrumb-link"
                                href="{{ route('backend.courses.list') }}">Courses</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Create Course</li>
                    </ol>
                </nav>

                <h1 class="page-header-title">Add Course</h1>

            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>

    <form action="{{ route('backend.courses.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8 mb-3 mb-lg-0">
                <div class="card mb-3 mb-lg-5">
                    <!-- Header -->
                    <div class="card-header">
                        <h4 class="card-header-title mb-0">Course information</h4>
                    </div>
                    <!-- End Header -->
                    <div class="card-body">
                        @include('includes.validation-form')
                        <div class="mb-4">
                            <label for="CourseNameLabel" class="form-label">Name</label>
                            <input type="text" name="name" id="CourseNameLabel" class="form-control" value="{{ old('name') }}">
                        </div>

                        <div class="mb-4">
                            <label for="categpory">Category</label>
                            <select name="category" id="categpory" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
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
