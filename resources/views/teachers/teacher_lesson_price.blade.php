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
        <a class="nav-link" href="{{route('teachers_profile.index')}}"><i class="bx bx-user me-1"></i> Kişisel Bilgiler</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('teachers_profile.lessons')}}"
          ><i class="bx bx-blanket  me-1"></i>Ders Sınıf Seçimi</a
        >
      </li>
      <li class="nav-item">
        <a class="nav-link  active" href="{{route('teachers_profile.lessonPrice')}}"
          ><i class="bx bx-money  me-1"></i>Ders Süre/Ücret Bilgisi</a
        >
      </li>
        <li class="nav-item">
        <a class="nav-link" href="{{route('teachers_profile.info')}}"
          ><i class="bx bx-news  me-1"></i>Profil Bilgileri</a
        >
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="{{route('teachers_profile.front')}}"
          ><i class="bx bx-world me-1"></i> Profil Önizleme</a
        >
      </li>
    </ul>
    <div class="card mb-4">
      <h5 class="card-header">Ders Süre/Ücret Bilgileri</h5>
      <!-- Account -->
      
      <hr class="my-0" />
    </div>
      <div class="col-md-12" >
          <div class="card mb-4">
            <div class="card-body mb-3" >
                <small>Vereceğiniz derslerin dakika ve ücret bilgisini giriniz. </small>
                <div class="table-responsive text-nowrap">
                <table class="table">
                  <thead>
                    <tr>
                      <th>Ders</th>
                      <th>Süre(Dk)</th>
                      <th>Yüzyüze Fiyat(TL)</th>
                      <th>Online Fiyat(TL)</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                @foreach ($data['lessonPrice'] as $lesson)
                @if ($lesson->visible==1 && !empty($lesson->lesson->title))
                <tr>
                  <td><strong>{{$lesson->lesson->title}}<input hidden class="form-control" name="lesson_id[{{$lesson->lesson_id}}]" value="{{$lesson->lesson_id}}"  /></strong></td>
                  <td><input class="form-control" min="0" type="number"id=""name="lesson_minute[{{$lesson->lesson_id}}]"value="{{$lesson->lesson_minute}}"autofocus /></td>
                  <td><input class="form-control" min="0" type="number"id=""name="lesson_face_price[{{$lesson->lesson_id}}]"value="{{$lesson->lesson_face_price}}" autofocus /></td>
                  <td><input class="form-control" min="0" type="number"id=""name="lesson_online_price[{{$lesson->lesson_id}}]"value="{{$lesson->lesson_online_price}}" autofocus /></td>
                            
                </tr>
                @endif
                    
                @endforeach
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