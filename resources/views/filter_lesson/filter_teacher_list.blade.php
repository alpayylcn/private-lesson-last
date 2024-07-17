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
   
@endsection
@section('content')
<div class="album py-5">
  <div class="container">

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
    {{-- @dd($teacherListData['teachersData'])   --}}
    
@forelse ($teacherListData['teachersData'] as $teacherData)

  <form action="{{route('all_step_filter.searchEnd')}}"  method="POST"> 
  @csrf
<div class="col-md">
        <div style="border: 2px solid" class="card mb-3"> 
          <div class="row g-0">
            <div class="col-md-5">
              @if (!empty($teacherData->user->userDetails))
              <img class="card-img card-img-left p-1" src="{{asset('backend/assets')}}/img/profileimages/{{ $teacherData->user->userDetails->profile_image ?: '/no_image.jpg' }}" alt="Card image" />
              @endif
             
              
            </div> 
             
            <div class="col-md-7">
              <div class="card-body">
                <h6 class="card-title">{{$teacherData->user->name}} {{$teacherData->user->surname}} - {{$teacherData->lesson->title}}</h6> 
                
                <p class="card-text">
                  15 Yıllık tecrücesi ile derslerinizde başarılı olmak için randevu alın.
                
                </p>
                
              </div>
              </div>
          </div>
          <hr style="border: 2px solid">
          <div class="row g-0">
            <div class="p-2 col-md-6">
              <input type="hidden" name="select_teacher_id" value="{{$teacherData->user->id}}">
              
          <button type="submit"  class="btn btn-outline-primary">ÖĞRETMENDEN RANDEVU AL </button></div>
          <div class="p-2 col-md-6">
          <button type="submit" class="btn btn-outline-danger">ÖĞRETMEN PROFİLİNİ GÖR</button></div>
          </div>
      </div>
        
      </div>
    </form>
@empty
<div  class="card mb-3">
 <p class="m-3">Aradığınız kriterlere uygun öğretmen bulunamadı...</p> 
</div>
@endforelse
   
    </div>
 </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">

     <form action="" method="POST"> 
      @csrf

      <input type="text" style="display: none" name="pivot_id" value="">

        <h5 style="text-transform:capitalize" class="modal-title" id="modalCenterTitle">Özel Ders Ara</h5>
      </div>
      <div class="modal-body">
        
        
        <input  type="text" name="lesson_dt" id="lesson_dt" value=""/>
      


      
        <div class="row">
          <div class="col-lg-12 mb-3">
            <label for="nameWithTitle" class="form-label">Adınız Soyadınız</label>
            <input
              type="text"
              id="student_name"
              class="form-control"
              name="student_name"
              placeholder="Adınızı ve Soyadınızı Yazınız"
              required
            />
          </div>
          <div class="col-lg-12 mb-3">
            <label  class="form-label">Telefon Numaranız</label>
            <input
              type="text"
              id="student_phone"
              class="form-control"
              name="student_phone"
              placeholder="Telefon Numaranızı Yazınız"
              required
            />
          </div>
          
        </div>
        
          <div class="col-lg-12 mb-0">
            <label  class="form-label">Öğretmenin Bilmesi Gerekenler</label>
            <textarea
              rows="5"
              id="teachers_note"
              class="form-control"
              placeholder="Son olarak öğretmenin bilmesi gerekenler varsa ekleyiniz."
              name="teachers_note"
              
            ></textarea>
          </div>
                      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Kapat
        </button>
        <button type="submit" class="btn btn-info">GÖNDER</button>
        </div>
      </form> 
    </div>
  </div>
</div>


 @endsection

  

 