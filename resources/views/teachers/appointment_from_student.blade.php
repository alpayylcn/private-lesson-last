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


<div class="row">
  <form method="POST" action="{{route('teacher_to_lesson_price.lessonToPriceUpdate')}}" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="user_id" value="1">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      <li class="nav-item m-2">
        <a class="nav-link  active" href="{{ route('lesson.approve.page') }}">
            <i class="bx bx-alarm  me-1"></i>Ders Talepleri / Teklife Açık
        </a>
    <li class="nav-item m-2">
        <a class="nav-link  active" href="{{ route('teachers_profile.appointment_from_student') }}">
            <i class="bx bx-line-chart  me-1"></i>Ders Talepleri / İlanlardan Gelen
        </a>
  </ul>
    <div class="card mb-4">
      <h5 class="card-header">Öğrenciden Gelen Ders Talepleri</h5>
      <!-- Account -->
      
      <hr class="my-0" />
    </div>

    @forelse ($appointmentList as $appointment)
    @if($appointment->student_id)

    <div class="col-md-12" id="appointment-{{ $appointment->id }}">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 rounded shadow-sm">
              <h5 class="card-title mt-2">ÖĞRENCİ: {{$appointment->user->name}} {{$appointment->user->surname}}</h5>
              <div class="card-subtitle text-muted mb-3">Ders / Sınıf : {{$appointment->lesson->title}} / {{$appointment->class}}</div>
              <div class="card-subtitle text-muted mb-3">Telefon : {{$appointment->user->userDetails->phone}}</div>
            </div>
            <div class="col-md-6 rounded shadow-sm">
              <p class="card-text mt-2"><b>Öğretmene Not: </b><br>{{$appointment->note}}</p>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <a href="" class="text-warning">Talep Zamanı: {{$appointment->created_at->locale('tr')->diffForHumans()}}</a>
            </div>
            <div class="col-md-6 text-right">
              <a href="javascript:void(0)" data-id="{{ $appointment->id }}" class="btn btn-danger delete-appointment"style="float: right;">İlanı Kaldır</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    
      

      @elseif($appointment->unregistered_student_id)

      <div class="col-md-12" >
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">ÖĞRENCİ: {{$appointment->unregistered_student?->name}} {{$appointment->unregistered_student->surname}}</h5>
            <div class="card-subtitle text-muted mb-3">Ders / Sınıf :</div>
            <div class="card-subtitle text-muted mb-3">Telefon : </div>
            <p class="card-text">Öğretmene Not: <br>
              
            </p>
            <a href="javascript:void(0)" data-id="{{ $appointment->id }}" class="card-link delete-appointment">İlanı Kaldır</a>
          </div>
          </div>
        </div>
      @endif
      @empty
      <div class="col-md-12" >
        <div class="card mb-4 bg-warning">
          <div class="card-body">
      <td><strong>Şu Anda Herhangi Bir Ders İsteği Bulunmuyor...</strong></td>
    </div>
  </div>
</div>
      @endforelse


      
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


  $(document).on('click', '.delete-appointment', function(e) {
    e.preventDefault();
    var appointmentId = $(this).data('id');

    Swal.fire({
        title: 'Emin misiniz?',
        text: "Bu ilanı listenizden kaldırmak istediğinizden emin misiniz?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, kaldır!',
        cancelButtonText: 'Hayır, iptal et'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route("teacher.appointment.delete") }}',
                type: 'DELETE',
                data: {
                    appointment_id: appointmentId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if(response.success) {
                        Swal.fire(
                            'Silindi!',
                            response.message,
                            'success'
                        );
                        // Randevunun sayfadan kaldırılması
                        $('#appointment-' + appointmentId).remove();
                    }
                }
            });
        }
    });
});
  </script>

@endsection