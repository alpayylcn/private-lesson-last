@extends('master')
@section('title')
<title> Destek Hoca / ... </title>
@endsection

@push('custom-head')
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
@endpush

@section('js')
   
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
            <div class="card bg-info text-white mb-3">
              <div class="card-header"></div>
              <div class="card-body">
                <h5 class="card-title text-white">İSTEĞİNİZ GÖNDERİLDİ</h5>
                <p class="card-text">Öğretmenimiz verdiğiniz bilgiler doğrultusunda sizinle iletişim kuracaktır.

                </p>
              </div>
            </div>
          </div>

          <div class="col-md-12 col-xl-12">
            <div class="card shadow-none bg-transparent border border-warning mb-3">
              <div class="card-body">
                <h5 class="card-title"></h5>
                <div class="col-lg-12 mb-4 mb-xl-0">
                  <small class="text-light fw-semibold">Sorgu Özeti</small>
                  <div class="demo-inline-spacing mt-3">
                    <div class="list-group list-group-flush">
                      
                      @forelse ($studentFilters as $item)
                      @if ($item->step_question_id==1 )
                        <a style="text-transform:capitalize" class="list-group-item list-group-item-action">
                        <b> {{$item->stepQuestionTitle?->title}} : &nbsp;&nbsp;</b> {{$item->stepLessonTitle?->title}}</a> 
                      @elseif ($item->step_question_id==2 )
                        <a style="text-transform:capitalize" class="list-group-item list-group-item-action">
                        <b> {{$item->stepQuestionTitle?->title}} : &nbsp;&nbsp;</b> {{$item->stepClassTitle?->title}}</a>
                      @else
                        <a style="text-transform:capitalize" class="list-group-item list-group-item-action">
                        <b> {{$item->stepQuestionTitle?->title}} : &nbsp;&nbsp;</b> {{$item->stepOptionTitle?->title}}</a>  
                      @endif
                        
                      @empty
                          <a style="text-transform:capitalize" class="list-group-item list-group-item-action">
                        <b> SORGUYA AİT BİLGİLER ALINAMADI... </b> </a>
                      @endforelse
                     
                    </div>
                  </div>
                </div>
                <p class="card-text"></p>
              </div>
            </div>
          </div>
          
            
          
          <div class="col-md-12 col-xl-12">
            <div class="card shadow-none bg-transparent border border-success mb-3">
              <div class="card-body">
                <h5 class="card-title"></h5>
                <p class="card-text"></p>
              </div>
            </div>
          </div>
            

            
            

            

         
        </div>
      </div>
      <!-- Register Card -->
    </div>
  </div>
</div>


 @endsection

  

 