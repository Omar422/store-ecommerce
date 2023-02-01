@extends('layouts.admin')

@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.dashboard') }}">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('admin.products') }}"> المنتجات </a>
                                </li>
                                <li class="breadcrumb-item active"> إضافة منتج </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> إضافة منتج جديد </h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{ route('admin.products.general.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <h4 class="form-section"><i class="ft-home"></i> البيانات الأساسية للمنتج </h4>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> اسم المنتج</label>
                                                        <input type="text" id="" class="form-control"
                                                            placeholder="" value="{{ old('name') }}" name="name">
                                                        @error('name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الاسم بالرابط</label>
                                                        <input type="text" id="" class="form-control"
                                                            placeholder="" value="{{ old('slug') }}" name="slug">
                                                        @error('slug')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="block" for=""> وصف المنتج </label>
                                                        <button type="button" onclick="f1()"
                                                            class="mx-1 shadow-sm btn btn-outline-secondary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Bold Text">Bold</button>
                                                        <button type="button" onclick="f2()"
                                                            class="mx-1 shadow-sm btn btn-outline-success"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Italic Text">Italic</button>
                                                        <button type="button" onclick="f3()"
                                                            class="mx-1 shadow-sm btn btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top" title="Left Align"><i
                                                                class="fas fa-align-left"></i></button>
                                                        <button type="button" onclick="f4()"
                                                            class="mx-1 btn shadow-sm btn-outline-secondary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Center Align"><i
                                                                class="fas fa-align-center"></i></button>
                                                        <button type="button" onclick="f5()"
                                                            class="mx-1 btn shadow-sm btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Right Align"><i class="fas fa-align-right"></i></button>
                                                        <button type="button" onclick="f6()"
                                                            class="mx-1 btn shadow-sm btn-outline-secondary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Uppercase Text">Upper Case</button>
                                                        <button type="button" onclick="f7()"
                                                            class="mx-1 btn shadow-sm btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Lowercase Text">Lower Case</button>
                                                        <button type="button" onclick="f8()"
                                                            class="mx-1 btn shadow-sm btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Capitalize Text">Capitalize</button>
                                                        <button type="button" onclick="f9()"
                                                            class="mx-1 btn shadow-sm btn-outline-primary side"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Tooltip on top">Clear Text</button>
                                                        <textarea name="description" id="textarea1" rows="5" value="{{ old('description') }}" class="form-control"></textarea>
                                                        @error('description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="block" for=""> الوصف المختصر </label>
                                                        <button type="button" onclick="f1()"
                                                            class="mx-1 shadow-sm btn btn-outline-secondary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Bold Text">Bold</button>
                                                        <button type="button" onclick="f2()"
                                                            class="mx-1 shadow-sm btn btn-outline-success"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Italic Text">Italic</button>
                                                        <button type="button" onclick="f3()"
                                                            class=" mx-1 shadow-sm btn btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Left Align"><i class="fas fa-align-left"></i></button>
                                                        <button type="button" onclick="f4()"
                                                            class="mx-1 btn shadow-sm btn-outline-secondary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Center Align"><i
                                                                class="fas fa-align-center"></i></button>
                                                        <button type="button" onclick="f5()"
                                                            class="mx-1 btn shadow-sm btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Right Align"><i
                                                                class="fas fa-align-right"></i></button>
                                                        <button type="button" onclick="f6()"
                                                            class="mx-1 btn shadow-sm btn-outline-secondary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Uppercase Text">Upper Case</button>
                                                        <button type="button" onclick="f7()"
                                                            class="mx-1 btn shadow-sm btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Lowercase Text">Lower Case</button>
                                                        <button type="button" onclick="f8()"
                                                            class="mx-1 btn shadow-sm btn-outline-primary"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Capitalize Text">Capitalize</button>
                                                        <button type="button" onclick="f9()"
                                                            class="mx-1 btn shadow-sm btn-outline-primary side"
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Tooltip on top">Clear Text</button>
                                                        <textarea name="short_description" id="" rows="5" value="{{ old('short_description') }}"
                                                            class="form-control">
                                                        </textarea>
                                                        @error('short_description')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mt-1">
                                                        <label class="card-title ml-1">
                                                            اختر القسم
                                                        </label>
                                                        <select name="categories[]" id=""
                                                            class="select2 form-control" multiple>
                                                            <optgroup label="اختر القسم">
                                                                @if ($categories && $categories->count() > 0)
                                                                    @foreach ($categories as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('categories.0')
                                                            <span class="text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mt-1">
                                                        <label class="card-title ml-1">
                                                            اختر العلامات
                                                        </label>
                                                        <select name="tags[]" id=""
                                                            class="select2 form-control" multiple>
                                                            <optgroup label="اختر العلامات">
                                                                @if ($tags && $tags->count() > 0)
                                                                    @foreach ($tags as $tag)
                                                                        <option value="{{ $tag->id }}">
                                                                            {{ $tag->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('tags')
                                                            <span class="text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mt-1">
                                                        <label class="card-title ml-1">
                                                            اختر العلامة التجارية
                                                        </label>
                                                        <select name="brand_id" id=""
                                                            class="select2 form-control" multiple>
                                                            <optgroup label="اختر العلامة التجارية">
                                                                @if ($brands && $brands->count() > 0)
                                                                    @foreach ($brands as $brand)
                                                                        <option value="{{ $brand->id }}">
                                                                            {{ $brand->name }}
                                                                        </option>
                                                                    @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('brand_id')
                                                            <span class="text-danger">
                                                                {{ $message }}
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mt-1">
                                                        <input type="checkbox" value="1" name="is_active"
                                                            id="switcheryColor4" class="switchery" data-color="success"
                                                            checked />
                                                        <label for="switcheryColor4"
                                                            class="card-title ml-1">الحالة</label>

                                                        @error('is_active')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> إضافة
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop

@section('script')
    <script>
        function f1() {
            //function to make the text bold using DOM method
            document.getElementById("textarea1").style.fontWeight = "bold";
        }

        function f2() {
            //function to make the text italic using DOM method
            document.getElementById("textarea1").style.fontStyle = "italic";
        }

        function f3() {
            //function to make the text alignment left using DOM method
            document.getElementById("textarea1").style.textAlign = "left";
        }

        function f4() {
            //function to make the text alignment center using DOM method
            document.getElementById("textarea1").style.textAlign = "center";
        }

        function f5() {
            //function to make the text alignment right using DOM method
            document.getElementById("textarea1").style.textAlign = "right";
        }

        function f6() {
            //function to make the text in Uppercase using DOM method
            document.getElementById("textarea1").style.textTransform = "uppercase";
        }

        function f7() {
            //function to make the text in Lowercase using DOM method
            document.getElementById("textarea1").style.textTransform = "lowercase";
        }

        function f8() {
            //function to make the text capitalize using DOM method
            document.getElementById("textarea1").style.textTransform = "capitalize";
        }

        function f9() {
            //function to make the text back to normal by removing all the methods applied
            //using DOM method
            document.getElementById("textarea1").style.fontWeight = "normal";
            document.getElementById("textarea1").style.textAlign = "left";
            document.getElementById("textarea1").style.fontStyle = "normal";
            document.getElementById("textarea1").style.textTransform = "capitalize";
            document.getElementById("textarea1").value = " ";
        }
    </script>
@stop
