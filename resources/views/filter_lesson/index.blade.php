@extends('master')
@section('title')
    <title> Destek Hoca / ... </title>
@endsection

@push('custom-head')
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/vendor/css/theme-default.css"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('backend/assets') }}/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{ asset('backend/assets') }}/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('backend/assets') }}/js/config.js"></script>
@endpush

@section('js')
@endsection
@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">

                <form action="{{ route('all_step_filter.stepCreate') }}" method="POST">
                    @csrf

                    <div class="card border-success">
                        <div class="text-center mt-4">
                            <h5 style="text-transform:uppercase">Özel Ders Ara</h5>
                        </div>
                        <div class="mb-3">
                            <div class="bg-white border m-2 rounded text-center ">


                                @if (!empty($stepCount) && !empty($filterStepData['stepNumber']))
                                    <b>ADIM {{ $filterStepData['stepNumber']->rank }} / {{ $stepCount->count() }} </b>
                                @endif
                            </div>
                        </div>
                        @if (!empty($filterStepData['stepNumber']))

                            <input type="hidden" name="question_id" value="{{ $filterStepData['stepNumber']->id }}">
                            <input type="hidden" name="question_rank" value="{{ $filterStepData['stepNumber']->rank }}">
                            @if (!empty($createId))
                                <input type="hidden" name="create_id" value="{{ $createId }}">
                            @endif
                            <div class="text-center">
                                <h4 style="text-transform:capitalize">{{ $filterStepData['stepNumber']->title }}</h4>
                            </div>
                            <div class="checkboxcontrol1 btn-group-vertical m-4" role="group"
                                aria-label="Basic radio toggle button group" required>
                                @if ($filterStepData['stepOption'])
                                    @foreach ($filterStepData['stepOption'] as $option)
                                        @if (!empty($option->classes))
                                            <input type="radio" class="btn-check" value="{{ $option->classes->id }}"
                                                name="option_value" id="btnradio{{ $option->classes->id }}" required>
                                            <label class="btn btn-outline-info mt-2"
                                                for="btnradio{{ $option->classes->id }}">{{ $option->classes->title }}
                                            </label>
                                        @else
                                            <input type="radio" class="btn-check" value="{{ $option->id }}"
                                                name="option_value" id="btnradio{{ $option->id }}" required>
                                            <label class="btn btn-outline-info mt-2"
                                                for="btnradio{{ $option->id }}">{{ $option->title }} </label>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        @endif

                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger col-lg-12 mt-2">
                                    {{ $error }}</div>
                            @endforeach
                        @endif
                        <div class="card-footer bg-transparent border-success shadow">
                            <div class="d-grid gap-2 col-lg-12 mx-auto">
                                <button type="submit" class="btn btn-info btn-lg" type="button"><b>DEVAM ET</b></button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
