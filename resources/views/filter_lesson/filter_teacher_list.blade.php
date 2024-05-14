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
   js kodlar
@endsection
@section('content')
<div class="album py-5">
  <div class="container">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      

    

      <div class="col-md-12 col-xl-12">
        <div class="card shadow-none bg-transparent border border-warning mb-3">
          <div class="card-body">
            <h5 class="card-title"></h5>
            <div class="col-lg-12 mb-4 mb-xl-0">
              <small class="text-light fw-semibold">Sorgu Özeti</small>
              <div class="demo-inline-spacing mt-3">
                <div class="list-group list-group-flush">
                  <a style="text-transform:capitalize" class="list-group-item list-group-item-action"
                    ><b>Ders :</b> {{$studentFilters->lesson->title}}</a
                  ><a style="text-transform:capitalize" class="list-group-item list-group-item-action"
                    ><b>Sınıf :</b> {{$studentFilters->classes->title}}</a
                  >
                  <a style="text-transform:capitalize"  class="list-group-item list-group-item-action"
                    ><b>Dersin Yapılacağı Yer :</b>  {{$studentFilters->filter_lesson_location->title}}</a
                  >
                  <a  style="text-transform:capitalize" class="list-group-item list-group-item-action"
                    ><b>Ders Kimin İçin :</b>  {{$studentFilters->filter_who->title}}</a
                  >
                  <a style="text-transform:capitalize" class="list-group-item list-group-item-action"
                    ><b>Haftada Kaç Kez :</b>  {{$studentFilters->filter_week_time->title}}</a
                  >
                  <a style="text-transform:capitalize" class="list-group-item list-group-item-action"
                    ><b>Ne Zamana Kadar :</b>  {{$studentFilters->filter_lesson_time_period->title}} </a
                  >
                  <a style="text-transform:capitalize" class="list-group-item list-group-item-action"
                    ><b>Ne Zaman Başlayacak :</b>  {{$studentFilters->filter_lesson_start_time->title}} </a
                  >
                </div>
              </div>
            </div>
            <p class="card-text"></p>
          </div>
        </div>
      </div>
      




      
      @foreach ($teachersData as $teacherData)

    {{-- <form action="{{route('dersaraend')}}"  method="POST">  --}}
        @csrf

        {{-- <input type="text" style="display: none" name="pivot_id" value="{{$pivot_id}}"> --}}

      <div class="col-md">
        <div style="border: 2px solid" class="card mb-3">
          <div class="row g-0">
            <div class="col-md-5">
              <img class="card-img card-img-left p-1" src="{{asset('backend/assets')}}/img/avatars/teachers_avatar_male.jpg" alt="Card image" />
              
            </div> 
            
            <div class="col-md-7">
              <div class="card-body">
                <h6 class="card-title">{{$teacherData->teacher_name}} - {{$teacherData->lesson->title}}</h6> 
                
                <p class="card-text">
                  15 Yıllık tecrücesi ile derslerinizde başarılı olmak için randevu alın.
                
                </p>
                {{-- <p class="card-text"><small class="text-muted">{{$teacher_data->teacher_image}}</small></p> --}}
                
              </div>
              {{-- <input type="text" style="display: none" name="teachers_name_surname" value="{{$teacher_data->user->name}} {{$teacher_data->user->surname}}"> --}}
              {{-- <input type="text" style="display: none" name="teachers_email" value="{{$teacher_data->user->surname}}"> --}}
              {{-- <button type="submit" class="btn btn-outline-primary m-2">RANDEVU AL</button> --}}
            </div>
          </div>
          <hr style="border: 2px solid">
          <div class="row g-0">
            <div class="p-2 col-md-6">
          <button type="submit" class="btn btn-outline-primary">ÖĞRETMENDEN RANDEVU AL</button></div>
          <div class="p-2 col-md-6">
          <button type="submit" class="btn btn-outline-danger">ÖĞRETMEN PROFİLİNİ GÖR</button></div>
          </div>
      </div>
        
      </div>
    </form>
      @endforeach
      
      

      
    </div>


    
  </div>
</div>
 @endsection

  

 