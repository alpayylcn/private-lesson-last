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
  <form method="POST" action="{{route('teachers_profile.updateLessonClassLocation')}}" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="user_id" value="1">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item">
        <a class="nav-link" href="{{route('users_profile.index')}}"><i class="bx bx-user me-1"></i> Kişisel Bilgiler</a>
      </li>
      <li class="nav-item">
        <a class="nav-link  active" href="{{route('teachers_profile.lessons')}}"
          ><i class="bx bx-blanket  me-1"></i>Ders Sınıf Seçimi</a
        >
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('teachers_profile.lessonPrice')}}"
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
      <h5 class="card-header">Ders/Sınıf Bilgileri</h5>
      <!-- Account -->
      
      <hr class="my-0" />
    </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="card mb-4">
                    <h5 class="card-header">Branş Seçenekleri</h5>
                    <div class="card-body mb-3"style="overflow-y: auto; height:150px;">
                      {{-- <label for="exampleFormControlSelect2" class="form-label">Yeni Ders Ekleyiniz</label> --}}
                      <div class="mb-3" >
                        {{-- <form id="itemsForm" action="{{route('teacher_lesson_to_class.lessonToClassesAjax')}}" method="POST"> 
                         @csrf--}}
                        @foreach ($data['lessons'] as $lesson){{-- Tüm dersler --}}
                          <div class="form-check checkbox payment-radio mb-2">
                            <input class="form-check-input lesson_click"  name="item_ids[{{$lesson->id}}]" 
                              @foreach ($data['teacherToLesson'] as $tToLesson){{-- Öğretmenin seçtiği dersler --}}
                                @if ($tToLesson->lesson_id == $lesson->id)
                                @checked(true)
                                @endif 
                              @endforeach 
                                type="checkbox" value="{{$lesson->id}}"  id="{{$lesson->id}}"/>
                            <label class="form-check-label" for="{{$lesson->id}}"> {{$lesson->title}} </label>
                          </div>
                        @endforeach
                        {{-- </form> --}}
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="card mb-4">
                    <h5 class="card-header">Sınıf/Kurs Seçenekleri</h5>
                      <div class="card-body mb-3" style="overflow-y: auto; height:150px;">
                        {{-- <label for="exampleFormControlSelect2" class="form-label">Yeni sınıf ekleyiniz</label> --}}
                            <div class="col-md" id="checkbox-container">

                              @foreach ($data['classes'] as $class){{-- Tüm dersler --}}
                          <div class="form-check checkbox payment-radio mb-2">
                            <input class="form-check-input" value="{{$class->id}}" name="class_id[{{$class->id}}]" 
                              @foreach ($data['teacherToClass'] as $tToClass){{-- Öğretmenin seçtiği dersler --}}
                                @if ($tToClass->class_id == $class->id)
                                @checked(true)
                                @endif 
                              @endforeach 
                                type="checkbox" value="{{$lesson->id}}"  id="{{$lesson->id}}"/>
                            <label class="form-check-label" for="{{$class->id}}"> {{$class->title}} </label>
                          </div>
                        @endforeach

                             </div>
                      </div>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="card mb-4">
                    <h5 class="card-header">Dersin Yapılacağı Yer</h5>
                      <div class="card-body mb-3" style="overflow-y: auto; height:150px;">
                        <label for="exampleFormControlSelect2" class="form-label">Yeni lokasyon ekleyiniz</label>
                            <div class="col-md">
                              @foreach ($data['locations'] as $location){{-- Tüm lokasyonlar --}}
                                <div class="form-check checkbox payment-radio mb-2" required >
                                  <input class="form-check-input" name="location_id[{{$location->id}}]" 
                                  @foreach ($data['teacherToLocation'] as $tToLocation){{-- Öğretmenin seçtiği lokasyonlar --}}
                                    @if ($tToLocation->location_id == $location->id)
                                    @checked(true)
                                    @endif 
                                  @endforeach 
                                    type="checkbox" id="inlineCheckbox1" value="{{$location->id}}" />
                                  <label class="form-check-label" for="inlineCheckbox1">{{$location->teacher_title}}</label>
                                </div>
                              @endforeach
                            </div>
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
          $('.lesson_click').change(function() {
                // Eğer hiç checkbox işaretli değilse, butonu pasif yap
                if ($('.lesson_click:checked').length === 0) {
                    $('#submit').prop('disabled', true);
                } else {
                    $('#submit').prop('disabled', false);
                }
            });

            // İlk başta hiç checkbox işaretli değilse, butonu pasif yap
            if ($('.lesson_click:checked').length === 0) {
                $('#submit').prop('disabled', true);
            }  

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