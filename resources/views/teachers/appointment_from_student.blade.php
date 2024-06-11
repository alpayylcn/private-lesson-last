@extends('master')
@section('title')
<title> Destek Hoca / ... </title>
@endsection

@section('css')
   
@endsection




@section('content')
   
<!-- Content wrapper -->
<div class="content-wrapper">
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ayarlar /</span> Profil Sayfası</h4>

<div class="row">
  <form method="POST" action="{{route('teacher_to_lesson_price.lessonToPriceUpdate')}}" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="user_id" value="1">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      
      
      <li class="nav-item">
        <a class="nav-link  active" href="{{route('teachers_profile.lessonPrice')}}"
          ><i class="bx bx-money  me-1"></i>Ders Talepleri / Öğrenciden</a>
      
      
     
    </ul>
    <div class="card mb-4">
      <h5 class="card-header">Öğrenciden Gelen Ders Talepleri</h5>
      <!-- Account -->
      
      <hr class="my-0" />
    </div>
      <div class="col-md-12" >
          <div class="card mb-4">
            <div class="card-body mb-3" >
                <small>Lütfen en kısa zamanda öğrenciniz ile iletişime geçiniz. </small>
                <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Öğrenci Adı</th>
                      <th>Öğrenci Soyadı</th>
                      {{-- <th>Sınıfı</th> --}}
                      <th>Telefon Numarası</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                @forelse ($appointmentList as $appointment)
                
                   @if($appointment->unregistered_student_id)
                      </tr>
                        <td><strong>{{$appointment->unregistered_student_id}}</strong></td> 
                        <td><strong>DDD</strong></td> 
                        {{-- <td><strong>DDD</strong></td> --}}
                        <td><strong><button type="button" class="form-control bg-primary text-white">GÖSTER</button></strong></td>
                      </tr>
                    
                    @elseif($appointment->student_id)
                    
                      </tr>
                        <td><strong>{{$appointment->user->name}}</strong></td> 
                        <td><strong>{{$appointment->user->surname}}</strong></td> 
                        {{-- <td><strong>DDD</strong></td> --}}
                        <td><strong><button type="button" class="form-control bg-primary text-white">GÖSTER</button></strong></td>
                      </tr>
                    @endif
                
                
                      
                @empty
                <td><strong>Şu Anda Herhangi Bir Randevu İsteği Bulunmuyor...</strong></td>
                @endforelse
                  
                
               
            </tbody>
          </table>
        </div>   
              </div>
    </div>

      </div>
      </div>
        <div class="card mb-4">
          <div class="card-body">
            <div class="mt-2">
              <button type="submit" id="submit" class="btn btn-primary me-2">KAYDET</button>   
              <div id="defaultFormControlHelp" class="form-text">
                Gönder butonuna bastığınızda verdiğiniz bilgilerin doğruluğunu onaylamış olursunuz.
              </div>
            </div>
</form>
            </div>
          </div>
        </div>
    </div>
  </div>
@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
      $(document).off('click', '.lesson_click').on('click', '.lesson_click', function() {
          var selectedItems = $('.lesson_click:checked').map(function() {
              return this.value; // Seçilen checkbox'ların değerlerini al
          }).get();
         
          $.ajax({
              type: "POST",
              url: "{{route('teacher_lesson_to_class.lessonToClassesAjax')}}",
              data: {
                  _token: $('input[name="_token"]').val(), 
                  item_ids: selectedItems 
              },
              success: function(response) {
                $("#checkbox-container input").remove();
                    $("#checkbox-container").html(response);
            }
          });
      });
  });
  </script>

@endsection