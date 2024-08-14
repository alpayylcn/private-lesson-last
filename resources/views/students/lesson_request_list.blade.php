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

   
   
  <div class="col-md-12">
   
    <div class="card mb-4">
      <h5 class="card-header">Oluşturduğunuz Talepler</h5>
      <!-- Account -->
      
    </div>
    
        <div class="row g-3" id="lesson-requests">
            @forelse ($lessonRequests as $request)
            <div class="col-md-4 lesson-request" data-id="{{ $request->id }}">
                <div class="p-3 border bg-light card">
                   
                  <p class="card-text text-danger">Talep Zamanı: {{ $request->formatted_request_time }}</p>
                  @if ($request->approval_count==0)
                 <p>Talebiniz Öğretmenlerimiz Tarafından Henüz Yanıtlanmadı.</p> 
                  @else
                  <p class="card-text text-primary">{{ $request->approval_count }} Öğretmenimiz Telefon Numaranızı Gördü.</p>  
                  @endif
                  
                  
                  <hr>
                  <h5 class="card-text">Talep Özeti</h5>

                  @php
                  // lessonRequest'in session_id'sine göre studentFilters verilerini filtrele
                  $filteredStudentFilters = $studentFiltersCollection->where('session_id', $request->session_id);
                    @endphp

                  @forelse ($filteredStudentFilters as $studentFilter)
                  @if ($studentFilter->step_question_id==1 )
                    <p class="card-text">
                        <b> {{$studentFilter->stepQuestionTitle?->title}} : &nbsp;&nbsp;</b> {{$studentFilter->stepLessonTitle?->title}}</a> 
                    </p>
                @elseif ($studentFilter->step_question_id==2 )
                    <p class="card-text">
                        <b> {{$studentFilter->stepQuestionTitle?->title}} : &nbsp;&nbsp;</b> {{$studentFilter->stepClassTitle?->title}}</a>
                    </p>
                @else
                    <p class="card-text">
                        <b> {{$studentFilter->stepQuestionTitle?->title}} : &nbsp;&nbsp;</b> {{$studentFilter->stepOptionTitle?->title}}</a>  
                    </p>
                @endif
                  @empty
                      Listelenecek öğe yok
                  @endforelse
                  
                  <hr>
                  <form class="cancel-form" data-request-id="{{ $request->id }}">
                    @csrf 
                    <input type="hidden" name="id" value="{{ $request->id }}">
                    <button type="button" class="btn btn-danger approve-btn">Talebi İptal Et</button>
                </form>
                </div>
            </div>  
            @empty
            Listelenecek öğe yok
            @endforelse
            
        </div>
    
        </div>
    </div>
  </div>
@endsection

@section('js')


<!-- jQuery ve SweetAlert2'yi dahil edin -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('.approve-btn').click(function() {
            var button = $(this);
            var form = button.closest('form');
            var formData = form.serialize(); // Form verilerini al
            var requestId = form.data('request-id');
            var url = '{{ route('lesson_request.cancel') }}'; // Sunucuya istek göndereceğimiz URL

            // SweetAlert2 ile onay penceresi
            Swal.fire({
                title: 'Bu talebi iptal etmek istediğinizden emin misiniz?',
                text: "Bu işlemi geri alamazsınız!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Evet, İptal Et!',
                cancelButtonText: 'Hayır, Vazgeç'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kullanıcı onayladıysa AJAX ile sunucuya istek gönder
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: formData, // Form verilerini gönder
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'İptal Edildi!',
                                    response.message,
                                    'success'
                                );
                                // Talebi sayfadan kaldır
                                button.closest('.lesson-request').remove();
                            } else {
                                Swal.fire(
                                    'Hata!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            var response = JSON.parse(xhr.responseText);
                            Swal.fire(
                                'Hata!',
                                response.message || 'Bir hata oluştu.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
    </script>

@endsection