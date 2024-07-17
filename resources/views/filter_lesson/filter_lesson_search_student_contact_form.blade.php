@extends('master')
@section('title')
    <title> Destek Hoca / ... </title>
@endsection

@section('css')
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
@endsection


@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="index.html" class="app-brand-link gap-2">

                                <span class="app-brand-text demo text-body fw-bolder">Destekhoca</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2"></h4>
                        <p class="mb-4"></p>

                        <div class="col-md-12 col-xl-12">
                            <div class="card bg-primary text-white mb-3">
                                <div class="card-header"></div>
                                <div class="card-body">
                                    <h5 class="card-title text-white">İLETİŞİM BİLGİSİ</h5>
                                    <p class="card-text">Sizinle irtibata geçebilmemiz için lütfen iletişim bilgilerinizi
                                        giriniz ve "Devam Et" butonuna basınız.

                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-xl-12">
                            <div class="card shadow-none bg-transparent border border-primary mb-3">
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <div class="col-lg-12 mb-4 mb-xl-0">

                                        <div class="demo-inline-spacing mt-3">
                                            <div class="list-group list-group-flush">

                                                <form class="mb-3"
                                                    action="{{ route('all_step_filter.contactFormCreate') }}"
                                                    method="POST">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="name" class="form-label">Adınız</label>
                                                        <input type="text"class="form-control" id="name" name="name"
                                                            placeholder="Adınız..." autofocus />
                                                        @if (!empty($selectTeacherId))
                                                            <input type="hidden"class="form-control" id="select_teacher_id"
                                                                name="select_teacher_id" value="{{ $selectTeacherId }}" />
                                                        @endif


                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="surname" class="form-label">Soyadınız</label>
                                                        <input type="text"class="form-control" id="surname"
                                                            name="surname" placeholder="Soyadınız..." autofocus />

                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="mail" class="form-label">Email</label>
                                                        <input type="text" class="form-control" id="mail"
                                                            name="mail" placeholder="Email adresiniz" />

                                                    </div>
                                                    <div>
                                                        <label for="phone" class="form-label">Telefon Numaranız</label>
                                                        <input type="text" class="form-control" id="phone"
                                                            name="phone" placeholder="Telefon Numaranız" />

                                                    </div>


                                                    @if ($errors->any())
                                                        @foreach ($errors->all() as $error)
                                                            <div class="alert alert-danger col-lg-12 mt-2">
                                                                {{ $error }}</div>
                                                        @endforeach
                                                    @endif



                                            </div>
                                        </div>
                                    </div>
                                    <p class="card-text"></p>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12 col-xl-12">
                            <div class="card shadow-none bg-transparent border border-primary">
                                <div class="card-body mb-3">
                                    <h5 class="card-title"></h5>

                                    <button type="submit" class="btn btn-primary d-grid w-100">DEVAM ET</button>
                                </div>
                            </div>
                        </div>

                        </form>






                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js"></script>


    {{-- Phone number inputmask --}}
    <script>
        $(document).ready(function() {
            $('#phone').inputmask('0(599) 999 99 99'); // .
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#photo').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#ProfilePhoto').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
