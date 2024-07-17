@extends('master')
@section('title')
<title> Destek Hoca / ... </title>
@endsection

@section('css')
   <!-- Icons. Uncomment required icon fonts -->
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/fonts/boxicons.css" />

   <!-- Core CSS -->
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/css/core.css" class="template-customizer-core-css" />
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
   <link rel="stylesheet" href="{{asset('backend/assets')}}/css/demo.css" />

   <!-- Vendors CSS -->
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

   <!-- Page CSS -->
   <!-- Page -->
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/css/pages/page-auth.css" />
   <!-- Helpers -->
   <script src="{{asset('backend/assets')}}/vendor/js/helpers.js"></script>

   <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
   <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
   <script src="{{asset('backend/assets')}}/js/config.js"></script>
@endsection

@section('js')
   js kodlar
@endsection
@section('content')
          <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row ">
                <div class="col-xl-12">
                  <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                      <h5 class="mb-0">Lütfen İletişim Bilgilerinizi Giriniz</h5>
                      
                    </div>
                    <div class="card-body">
                      <form>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Adınız</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i ></span>
                            <input type="text" class="form-control"name="student_name"/>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Soyadınız</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i ></span>
                            <input type="text" class="form-control"name="student_surname"/>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Email Adresiniz</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-envelope"></i ></span>
                            <input type="mail" class="form-control"name="student_mail"/>
                          </div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-fullname">Telefon Numaranız</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-phone"></i ></span>
                            <input type="phone" class="form-control"name="student_phone"/>
                          </div>
                        </div>
                        
                        <div class="mb-3">
                          <label class="form-label" for="basic-icon-default-message">Öğretmene Mesajınız</label>
                          <div class="input-group input-group-merge">
                            <span id="basic-icon-default-message2" class="input-group-text"><i class="bx bx-comment"></i></span>
                            <textarea name="student_message" class="form-control"></textarea>
                          </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">BİLGİLERİMİ GÖNDER</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
          </div>
 @endsection

  

 