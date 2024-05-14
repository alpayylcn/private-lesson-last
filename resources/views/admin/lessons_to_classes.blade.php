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
{{-- Top Buttons Start --}}
@include('admin.layout.top_buttons')
{{-- Top Buttons End --}}

<div class="row">
  <form method="POST" action="{{route('relation.LessonsToClassesUpdate')}}" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="add_user_id" value="{{$id}}">
  <div class="col-md-12">
    {{-- Top Buttons Start --}}
    @include('admin.layout.tabs_lesson_and_class')
    {{-- Top Buttons End --}}
    
  <div class="row">

    
      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">DERS SEÇİMİ</h5>
          <div class="card-body mb-3"style="overflow-y: auto; height:200px;">
             <div class="mb-3" >
                <select name="lesson_id" class="form-select" id="exampleFormControlSelect1" aria-label="Default select example">
                  <option value="">Dersi Seçiniz</option>
                  @foreach ($lessons as $lesson)
                  @if ($lesson->trashed())
                    <option value="{{$lesson->id}}" class="text-danger" >{{$lesson->title}} --- PASİF DURUMDA</option> 
                  @else
                    <option value="{{$lesson->id}}" >{{$lesson->title}}</option> 
                  @endif 
                  @endforeach
                </select>

                @if($errors->has('lesson_id'))
                    @foreach ($errors->get('lesson_id') as $error)
                      <div class="alert alert-danger mt-2 col-lg-12">{{ $error }}</div>
                    @endforeach
                  @endif 

                  @if($errors->has('add_user_id'))
                @foreach ($errors->get('add_user_id') as $errorUser)
                  <div class="alert mt-2 alert-danger">{{ $errorUser }}</div>
                @endforeach
              @endif
                 

                <div id="defaultFormControlHelp" class="form-text mb-1">
                  Ders seçimi yapıldıktan sonra derse uygun sınıfları seçip kaydet butonuna basınız.
                </div>
              </div>
            </div>
        </div>
      </div>
       <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">DERSE UYGUN SINIF SEÇİMİ</h5>
          <div class="card-body mb-3" >
            <div class="col-md" style="overflow-y: auto; height:200px;">
              
              

              @foreach ($classes as $class)
                <div class="form-check checkbox payment-radio">
                    <input class="form-check-input" name="class_id[{{$class->id}}]" type="checkbox" value="{{$class->id}}" id="defaultCheck1"/>
                    <label class="form-check-label" for="defaultCheck1"> {{$class->title}}</label>
                </div>
              @endforeach
              </div>
              
              @if($errors->has('class_id'))
              @foreach ($errors->get('class_id') as $error)
                <div class="alert alert-danger mt-2 col-lg-12">{{ $error }}</div>
              @endforeach
          @endif 

          </div>
          
             
        </div>
       </div>
       <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <div class="mt-2">
              <button type="submit" id="submit" class="btn btn-primary me-2">KAYDET</button>   
            </div>
          </div>
        </div>
       </div>
      </div>

    

  </form>

    <div class="row">
      </div>
        <div class="card mb-4">
          <h5 class="card-header">EŞLEŞTİRİLMİŞ DERSLER LİSTESİ</h5>
        </div>
        </div>
        @foreach ($lessonsData as $lesson)
        @if (!empty($lesson->lesson->title))
        <div class="col-md-2">
          <div class="card mb-4">
            @if ($lesson->lesson->trashed())
            <h5 class="card-header text-danger">{{$lesson->lesson->title}} --- PASİF</h5>
            @else
            <h5 class="card-header">{{$lesson->lesson->title}}</h5>
            @endif
            <div class="card-body mb-3" style="overflow-y: auto; height:200px;">
              @foreach ($classesData as $class)
              <div class="col-md" id="itemList">
                 @if ($lesson->lesson_id == $class->lesson_id) 
                  @if (!empty($class->classes->title))
                  <div class="form-check checkbox payment-radio">
                      <input class="form-check-input class_click" checked name="class_id[{{$class->id}}]" type="checkbox" value="{{$class->id}}" id="classCheckbox{{$class->id}}"/>
                      <label class="form-check-label" for="classCheckbox{{$class->id}}"> {{$class->classes->title}}</label>
                  </div>
                  @endif
                @endif 
              </div> @endforeach
            </div>
          </div>
        </div>
        @endif
        @endforeach
    </div>
    </div>
  </div>

@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
      $(document).off('click', '.class_click').on('click', '.class_click', function() {
          var selectedItems = $('.class_click:checked').map(function() {
              return this.value; // Seçilen checkbox'ların değerlerini al
          }).get();
          var unselectedItems = $('.class_click:not(:checked)').map(function() {
                    return $(this).val();
                }).get();
          $.ajax({
              type: "POST",
              url: "{{route('admin_lesson_to_class.adminLessonToClassesAjax')}}",
              data: {
                  _token: $('input[name="_token"]').val(), 
                  item_ids: selectedItems 
              },
              success: function(response){
                 $.each(unselectedItems, function(index, itemId) {
                             $('#itemList .form-check #classCheckbox' + itemId).closest('.form-check').remove();
                         });

                //alert(response.message); // Başarı mesajını göster
                // İsteğe bağlı olarak sayfayı yeniden yükleyebilir veya güncelleyebilirsiniz
                //window.location.reload();
              }
          });
      });
  });
  </script>



@endsection