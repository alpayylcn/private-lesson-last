@extends('master')
@section('title')
<title> Destek Hoca / Filtreleme Ekranı </title>
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
  <form method="POST" action="{{route('admin.filterItemsUpdate')}}">
    @csrf 
    <input type="hidden" name="user_id" value="{{$userId}}">
  <div class="col-md-12">
    {{-- Top Buttons Start --}}
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item">
        <a class="nav-link  active" href="{{route('admin.filterItems')}}">
        <i class="bx bx-blanket  me-1"></i>Filtre Adımları / Sorular</a>
      </li>
      <li class="nav-item">
        <a class="nav-link border " href="{{route('admin.stepQuestions')}}">
        <i class="bx bx-blanket  me-1"></i>Opsiyonları Düzenle</a>
      </li>
       
      </ul> 
    {{-- Top Buttons End --}}
    @if($errors->any())
      @foreach ($errors->all() as $error)
        <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
      @endforeach
    @endif 
  
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="row">
          <h5 class="card-header">Filtreleme Adımları (Sorular)</h5>
          <div class="card-body mb-3">
            
            <table>
              <th>Sorular</th>
              <th>Sıra Numarası</th>
              @forelse ($data as $question )
                <tr id="{{$question->id}}"> 
                <td class="col-10"><input type="text" name="title[{{$question->id}}]" class="form-control" value="{{$question->title}}" placeholder=""></td>
                <td><input type="text" name="rank[{{$question->id}}]" class="form-control" value="{{$question->rank}}" placeholder=""></td>
                <td><button id="{{$question->id}}" type="button" class="btnstepforcedelete form-control btn-danger"><i class="bx bx-trash  me-2"></button></td>
              
                
              
                </tr>
              @empty
                <tr><td>KAYITLI SORU BULUNAMADI</td></tr>
              @endforelse
              
              
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
    </form>
    
      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">YENİ ADIM EKLEME </small></h5>
            <div class="card-body mb-3">
              
              <div id="defaultFormControlHelp" class="form-text mb-1">
                Soru eklerken sıra numarasını eklemeyi unutmayınız...
               </div>
               <form method="POST" action="{{route('admin.filterItemsAdd')}}" enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name="user_id" value="{{$userId}}">
                 <table id="classes_table">
                   <tr>
                   <td class="col-8"> <input type="text" name="title" class="form-control" placeholder="Soru"></td>
                   <td class="col-2"> <input type="text" name="rank" class="form-control" placeholder="Sıra Numarası"></td>
                   <td><button type="submit" class="addClass btn btn-warning me-2">EKLE</button></td>
                   </tr>  
                   </table>
                   
                  </form>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $('.btnstepforcedelete').click(function() {
    var id = $(this).attr('id');
    Swal.fire({
            title: 'Tamamen Silmek Üzeresin',
            text: "Bu İşlem Geri Alınamaz",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet Sil',
            cancelButtonText: 'Hayır Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                    type: "post",
                    url: "{{route('admin.filterItemsDelete')}}",
                    data:{_token:"{{ csrf_token() }}",id:id},
                    success: function(msg) {
                    if (msg) {
                      Swal.fire(
                      'Silindi!',
                      'İşleminiz Başarılı Bir Şekilde Gerçekleştirildi.',
                      'success'
                  );
                      setTimeout(function(){
                      window.location.reload(1);
                      }, 1000);
  
                        }
                    },
                    error: function(xhr, status, error) {
                        // Hata durumunda SweetAlert2 ile bir hata mesajı gösterilebilir
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: 'Üzgünüz İşleminiz gerçekleştirilemedi.'
                        });
                    }
                    
                });
            }
   });
  });
  </script>
@endsection