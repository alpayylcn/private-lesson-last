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
     
    <div id="lesson-requests">
      @foreach ($lessonRequests as $request)
          <div class="card mb-3 lesson-request" data-id="{{ $request->id }}">
              <div class="card-body">
                  <h5 class="card-title">{{ $request->student->name }} {{ $request->student->surname }}</h5>
                  <p class="card-text">Ders Adı: {{ $request->lesson->title }}</p>
                  <p class="card-text">Talep Zamanı: {{ $request->formatted_request_time }}</p>

                  @if (in_array(auth()->id(), json_decode($request->approved_teachers, true) ?? []))
                  <div class="phone-number">
                      Telefon Numarası: {{ $request->student->userDetails->phone }}
                  </div>
                  <button type="button" class="btn btn-success" disabled>Onaylandı</button>
                  @elseif ($request->approval_count >= 5)
                  <button type="button" class="btn btn-success" disabled>Onay Sınırına Ulaşıldı</button>
              @else
                 
                  <button type="button" class="btn btn-info approve-btn" data-request-id="{{ $request->id }}">Talebi Onayla / <small class="badge bg-primary text-wra">{{ $request->required_credits }} Kredi</small> </button>
              @endif


              </div>
          </div>
      @endforeach
  </div>
    
        
        </div>
    </div>
  </div>
@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
      // Onayla butonu tıklama işlemi
      $('.approve-btn').click(function() {
          var button = $(this);
          var card = button.closest('.lesson-request');
          var requestId = button.data('request-id');
  
          // Onaylama işlemi başlatılıyor
          $.ajax({
              url: '{{ route('lesson.approve.ajax') }}',
              method: 'POST',
              data: {
                  request_id: requestId,
                  _token: '{{ csrf_token() }}'
              },
              success: function(response) {
                  if (response.status === 200) {
                      // Başarılı onaylama durumunda butonu pasif hale getir ve telefon numarasını göster
                      button.prop('disabled', true);
                      button.text('Onaylandı');
                      card.find('.phone-number').remove();
                      card.append('<div class="phone-number">Telefon Numarası: ' + response.phone + '</div>');
                      toastr.success(response.message);
                  } else {
                      toastr.error(response.message);
                  }
              },
              error: function(xhr) {
                  var response = JSON.parse(xhr.responseText);
                  toastr.error(response.message);
              }
          });
      });
  });
  </script>


@endsection