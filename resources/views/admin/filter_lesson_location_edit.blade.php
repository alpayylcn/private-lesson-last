@extends('master')
@section('title')
<title> Destek Hoca / Ders Lokasyonu </title>
@endsection

@section('css')
  
@endsection




@section('content')
   
<!-- Content wrapper -->
<div class="content-wrapper">
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
{{-- Top Buttons Start --}}
@include('admin.layout.top_buttons')
{{-- Top Buttons End --}}

<div class="row">
  <form method="POST" action="{{route('admin.filterLessonLocationUpdate')}}" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="user_id" value="{{$userId}}">
  <div class="col-md-12">
    {{-- Top Buttons Start --}}
    @include('admin.layout.tabs_filter_items')
    {{-- Top Buttons End --}}
    
    <div class="row">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="row">
          <h5 class="card-header">Ders Nerede Yapılsın?</h5>
          <div class="card-body mb-3">
            
            <table class="col-12">
              <th>Öğrenci Filtre Ekranı</th>
              <th>Öğretmenin Gördüğü</th>
             
              @foreach ($data as $location)
              <tr> 
                <td class="col-6"><input type="text" name="title[{{$location->id}}]" class="form-control" value="{{$location->title}}" placeholder=""></td>
                <td class="col-6"><input type="text" name="teacher_title[{{$location->id}}]" class="form-control" value="{{$location->teacher_title}}" placeholder=""></td>
               
              </tr>
              @endforeach
              
            </table>
            @if($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
            @endforeach
          @endif 
          @if($errors->has('user_id'))
            @foreach ($errors->get('user_id') as $errorUser)
              <div class="alert alert-danger mt-2">{{ $errorUser }}</div>
            @endforeach
          @endif
            <div class="mt-2">
              <button type="submit" id="submit" class="btn btn-primary me-2">GÜNCELLE</button>   
              <div id="defaultFormControlHelp" class="form-text">
                Güncelle butonuna bastığınızda verdiğiniz bilgilerin doğruluğunu onaylamış olursunuz.
              </div>
            </div>
          </div>
        </form>      
        </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card mb-4">
          <h5 class="card-header">YENİ BAŞLIK EKLEME </small></h5>
            <div class="card-body mb-3">
              
              <div id="defaultFormControlHelp" class="form-text mb-1">
               Ekle butonuna basarak yeni başlık ekleyebilirsiniz.
               </div>
               <form method="POST" action="{{route('admin.filterLessonLocationAdd')}}" enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name="add_user_id" value="{{$userId}}">
                 <table id="classes_table" class="col-12">
                   <tr>
                   <td class="col-12"> <input type="text" name="title" class="form-control" placeholder="Öğrencinin Göreceği Başlık"></td>
                   
                   </tr> 
                   <tr>
                    <td class="col-12"> <input type="text" name="teacher_title" class="form-control" placeholder="Öğretmenin Göreceği Başlık"></td>
                    
                    </tr> 
                    <tr>
                      <td><button type="submit" class="form-control btn-warning">EKLE</button></td>
                      </tr> 
                   </table>
                   @if($errors->has('title'))
                        @foreach ($errors->get('title') as $error)
                          <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
                        @endforeach
                    @endif 
                    @if($errors->has('teacher_title'))
                    @foreach ($errors->get('teacher_title') as $error)
                      <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
                    @endforeach
                @endif 
                    @if($errors->has('user_id'))
                        @foreach ($errors->get('user_id') as $errorUser)
                          <div class="alert alert-danger mt-2">{{ $errorUser }}</div>
                        @endforeach
                    @endif
                  </form>
            </div>
        </div>
      </div>
    
              </div>
                <div class="card mb-4">
                  <div class="card-body">
                    

                    </div>
                  </div>
                </div>
    </div>
    </div>
  </div>

@endsection

@section('js')



@endsection