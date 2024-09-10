@extends('master')
@section('title')
<title> Destek Hoca / ... </title>
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css"
        rel="stylesheet">
@endsection
@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

          <div class="row">
            @forelse ($teachers as $teacher)
            <div class="col-md-6 col-lg-4 mb-3">
              <div class="card">
                <div class="card-header">
                  <h4>
                    @php
                    $uniqueLessons = $teacher->teacherLessons->unique('lesson_id');
                  @endphp
                  @foreach ($uniqueLessons as $lesson)
                    {{$lesson->lesson->title}}
                  @endforeach  
                  </h4>
                 
                
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4 text-center">
                      <img src="{{asset('backend/assets')}}/img/profileimages/{{$teacher->userDetails->profile_image ?: '/no_image.jpg' }}"class="rounded border border-2 border-warning" alt="Öğretmen Profili" width="100">
                      <h5 class="mt-2">{{$teacher->name}} {{$teacher->surname}}</h5>
                    </div>
                    <div class="col-8">
                      <p class="card-text">Geometri ve Türkçe Dersleriniz için sizlere yardımcı olmaya hazırım. Tüm LGS ve YKS öğrencilerini bekliyorum.</p>
                      <p class="card-text"><i class="menu-icon tf-icons bx bx-map"></i><small class="text-muted">{{$teacher->userDetails->cityName->city }} / {{$teacher->userDetails->countyName->county }}</small></p>
                    </div>
                    
                  </div>
                </div>
                <hr class="my-3 mx-3">
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                      <p class="mb-0"><i class='bx bxs-star text-warning'></i> 4.5</p>
                      <p class="mb-0"><small>(20 yorum)</small></p>
                    </div>
                    <div class="col-6 text-end">
                      <p class="mb-0">{{$teacher->lessonPrices->first()->lesson_face_price}} TL / {{$teacher->lessonPrices->first()->lesson_minute}} dk </p>
                      <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2 open-modal" 
                       data-teacher-id="{{ $teacher->id }}" 
                       data-lessons="{{ json_encode($teacher->teacherLessons->unique('lesson_id')) }}">
                        Ders Talebi Gönder
                    </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            @empty
              
            @endforelse
            
          </div>

        </div>
    </div>

<!-- Ders Talebi Gönder Modalı -->  
<div class="modal fade" id="lessonRequestModal" tabindex="-1" aria-labelledby="lessonRequestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="lessonRequestModalLabel">Ders Talebi Gönder</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="lessonRequestForm">
                  @csrf
                  <input type="text" name="teacher_id" id="teacherId">

                  <!-- Ders ve Sınıf bilgileri (disabled input alanları) -->
                  <div class="mb-3">
                    
                    <input type="hidden" class="form-control" id="lessonName" name="lesson_id"  value="{{$lesson_id}}">
                  </div>

                  <div class="mb-3">
                    
                    <input type="hidden" class="form-control" id="className" name="class" value="{{$class_id}}">
                  </div>

                  <!-- Öğretmene Not için input alanı -->
                  <div class="mb-3">
                      <label for="noteInput" class="form-label">Öğretmene Not</label>
                      <textarea id="noteInput" name="note" class="form-control"></textarea>
                  </div>

                  <button type="submit" class="btn btn-primary">Ders Talebi Gönder</button>
              </form>
          </div>
      </div>
  </div>
</div>


@endsection

@section('js')
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>

<script>
$(document).ready(function() {
    $('.open-modal').on('click', function() {
      var teacherId = $(this).data('teacher-id');
      var lessons = $(this).data('lessons');

        // Modal içindeki form alanlarını doldur
        $('#teacherId').val(teacherId);
        // Modal'ı aç
        $('#lessonRequestModal').modal('show');
    });

    $('#lessonRequestForm').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '{{ route("teacher-appointment.store") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                toastr.success('Ders talebi başarıyla gönderildi!');
                $('#lessonRequestModal').modal('hide');
                // Gerekiyorsa sayfayı yenile
                location.reload();
            },
            error: function(xhr) {
                toastr.error('Bir hata oluştu. Lütfen tekrar deneyin.'+xhr.responseText);
            }
        });
    });
});

</script>
   
    
@endsection
  

 