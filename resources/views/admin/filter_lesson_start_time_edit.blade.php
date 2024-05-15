@extends('master')
@section('title')
<title> Destek Hoca / Ne Zaman Başlayacak </title>
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
  <form method="POST" action="" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="user_id" value="1">
  <div class="col-md-12">
    {{-- Top Buttons Start --}}
    @include('admin.layout.tabs_filter_items')
    {{-- Top Buttons End --}}
    
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="row">
          <h5 class="card-header">Ders Ne Zaman Başlayacak?</h5>
          <div class="card-body mb-3">
            
            <table class="col-12">
              <th>Başlıklar</th>
             
              @foreach ($data as $option)
              <tr> 
                <td class="col-12"><input type="text" name="title[{{$option->id}}]" class="form-control" value="{{$option->title}}" placeholder=""></td>
               
              </tr>
              @endforeach
              
            </table>
            
            <div class="mt-2">
              <button type="submit" id="submit" class="btn btn-primary me-2">GÜNCELLE</button>   
              <div id="defaultFormControlHelp" class="form-text">
                Güncelle butonuna bastığınızda verdiğiniz bilgilerin doğruluğunu onaylamış olursunuz.
              </div>
            </div>
          </div>
          
        </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">YENİ BAŞLIK EKLEME </small></h5>
            <div class="card-body mb-3">
              
              <div id="defaultFormControlHelp" class="form-text mb-1">
               Ekle butonuna basarak yeni başlık ekleyebilirsiniz.
               </div>
   
                 <table id="classes_table">
                   <tr>
                   <td class="col-10"> <input type="text" name="lesson1" class="form-control" placeholder=""></td>
                   <td><button type="submit" class="form-control btn-warning">EKLE</button></td>
                   </tr>  
                   </table>
            </div>
        </div>
      </div>
    
              </div>
                <div class="card mb-4">
                  <div class="card-body">
                    
  </form>
                    </div>
                  </div>
                </div>
    </div>
    </div>
  </div>

@endsection

@section('js')



@endsection