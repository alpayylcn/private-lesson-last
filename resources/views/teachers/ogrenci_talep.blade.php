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
   
    <input type="hidden" name="user_id" value="1">
  <div class="col-md-12">
    <ul class="nav nav-pills flex-column flex-md-row mb-3">
      
      
      <li class="nav-item">
        <a class="nav-link  active" href="{{route('teachers_profile.lessonPrice')}}"
          ><i class="bx bx-money  me-1"></i>Ders Talepleri / Teklife Açık</a>
      
      
     
    </ul>
    <div class="card mb-4">
      <h5 class="card-header">Teklife Açık Ders Talepleri</h5>
      <!-- Account -->
      
      <hr class="my-0" />
    </div>
     
    <h1>Ders İsteği</h1>
    <form id="student-request-form">
        @csrf
        <div class="form-group">
            <label for="lesson">Ders:</label>
            <select class="form-control" id="lesson_id" name="lesson_id" required>
                @foreach($lessons as $lesson)
                    <option value="{{ $lesson->id }}">{{ $lesson->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">İstek Gönder</button>
    </form>


        
        </div>
    </div>
  </div>
@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#student-request-form').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: '{{ route('lesson.request') }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                toastr.success(response.message);
            },
            error: function(xhr) {
                toastr.error(response.message);
            }
        });
    });
});
</script>

@endsection