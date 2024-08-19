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
                    <h5 class="card-header">Teklife Açık Ders Talepleri</h5>
                    <!-- Account -->
                </div>
                <div class="nav-align-top mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-home" aria-controls="navs-justified-home"
                                aria-selected="true">
                                <i class="tf-icons bx bx-calendar-edit"></i> Onaylanmamış Talepler
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{ $unapprovedRequests->count() }}</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-justified-profile" aria-controls="navs-justified-profile"
                                aria-selected="false">
                                <i class="tf-icons bx bx-calendar-check"></i> Onaylanmış Talepler
                                <span class="badge rounded-pill badge-center h-px-20 w-px-20 bg-label-danger">{{ $approvedRequests->count() }}</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="navs-justified-home" role="tabpanel">
                            <div class="row g-3" id="lesson-requests">
                                @forelse ($unapprovedRequests as $request)
                                    @if ($request->approval_count < 5 && $request->request_duration > 0)
                                        <div class="col-md-6 col-xl-4 lesson-request" data-id="{{ $request->id }}">
                                            <div class="p-3 border bg-light card">
                                                <h5 class="card-title">{{ $request->student->name }}
                                                    {{ $request->student->surname }} - {{ $request->lesson->title }}</h5>
                                                <p class="card-text"><b>İl / İlçe:</b>
                                                    {{ $request->student->userDetails->cityName->city }} /
                                                    {{ $request->student->userDetails->countyName->county }}</p>
                                                <p class="card-text text-danger">Talep Zamanı:
                                                    {{ $request->formatted_request_time }}</p>
                                                <hr>
                                                <h5 class="card-text">İlan Özeti</h5>
                                                @php
                                                    // lessonRequest'in session_id'sine göre studentFilters verilerini filtrele
                                                    $filteredStudentFilters = $studentFiltersCollection->where(
                                                        'session_id',
                                                        $request->session_id,
                                                    );
                                                @endphp

                                                @forelse ($filteredStudentFilters as $studentFilter)
                                                    @if ($studentFilter->step_question_id == 1)
                                                        <p class="card-text">
                                                            <b> {{ $studentFilter->stepQuestionTitle?->title }} :
                                                                &nbsp;&nbsp;</b>
                                                            {{ $studentFilter->stepLessonTitle?->title }}</a>
                                                        </p>
                                                    @elseif ($studentFilter->step_question_id == 2)
                                                        <p class="card-text">
                                                            <b> {{ $studentFilter->stepQuestionTitle?->title }} :
                                                                &nbsp;&nbsp;</b>
                                                            {{ $studentFilter->stepClassTitle?->title }}</a>
                                                        </p>
                                                    @else
                                                        <p class="card-text">
                                                            <b> {{ $studentFilter->stepQuestionTitle?->title }} :
                                                                &nbsp;&nbsp;</b>
                                                            {{ $studentFilter->stepOptionTitle?->title }}</a>
                                                        </p>
                                                    @endif
                                                @empty
                                                    Listelenecek öğe yok
                                                @endforelse
                                                <hr>
                                                @if ($request->teachers->contains(auth()->id()) && $request->teachers->find(auth()->id())->pivot->approved)
                                                    <div class="phone-number">
                                                        Telefon Numarası: {{ $request->student->userDetails->phone }}
                                                    </div>

                                                    <button type="button" class="btn btn-success"
                                                        disabled>Onaylandı</button>
                                                @elseif ($request->approval_count >= 5)
                                                    <button type="button" class="btn btn-success" disabled>Onay Sınırına
                                                        Ulaşıldı</button>
                                                @else
                                                    <button type="button" class="btn btn-info approve-btn"
                                                        data-request-id="{{ $request->id }}">Talebi Onayla / <small
                                                            class="badge bg-primary text-wra">{{ $request->required_credits }}
                                                            TL</small> </button>
                                                @endif

                                                <button type="button" class="btn btn-danger mt-2 remove-btn"
                                                    data-request-id="{{ $request->id }}">İlanı Listemden Kaldır</button>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="col-md-12">
                                        <div class="card p-5">Şu Anda Uygun Ders Talebi Bulunmamaktadır...</div>
                                    </div>
                                @endforelse

                            </div>
                        </div>
                        <div class="tab-pane fade" id="navs-justified-profile" role="tabpanel">
                            <div class="row g-3" id="lesson-requests">
                                @forelse ($approvedRequests as $request)
                                    @if ($request->approval_count < 5 && $request->request_duration > 0)
                                        <div class="col-md-6 col-xl-4 lesson-request" data-id="{{ $request->id }}">
                                            <div class="p-3 border bg-light card">
                                                <h5 class="card-title">{{ $request->student->name }}
                                                    {{ $request->student->surname }} - {{ $request->lesson->title }}</h5>
                                                <p class="card-text"><b>İl / İlçe:</b>
                                                    {{ $request->student->userDetails->cityName->city }} /
                                                    {{ $request->student->userDetails->countyName->county }}</p>
                                                <p class="card-text text-danger">Talep Zamanı:
                                                    {{ $request->formatted_request_time }}</p>
                                                <hr>
                                                <h5 class="card-text">İlan Özeti</h5>
                                                @php
                                                    // lessonRequest'in session_id'sine göre studentFilters verilerini filtrele
                                                    $filteredStudentFilters = $studentFiltersCollection->where(
                                                        'session_id',
                                                        $request->session_id,
                                                    );
                                                @endphp

                                                @forelse ($filteredStudentFilters as $studentFilter)
                                                    @if ($studentFilter->step_question_id == 1)
                                                        <p class="card-text">
                                                            <b> {{ $studentFilter->stepQuestionTitle?->title }} :
                                                                &nbsp;&nbsp;</b>
                                                            {{ $studentFilter->stepLessonTitle?->title }}</a>
                                                        </p>
                                                    @elseif ($studentFilter->step_question_id == 2)
                                                        <p class="card-text">
                                                            <b> {{ $studentFilter->stepQuestionTitle?->title }} :
                                                                &nbsp;&nbsp;</b>
                                                            {{ $studentFilter->stepClassTitle?->title }}</a>
                                                        </p>
                                                    @else
                                                        <p class="card-text">
                                                            <b> {{ $studentFilter->stepQuestionTitle?->title }} :
                                                                &nbsp;&nbsp;</b>
                                                            {{ $studentFilter->stepOptionTitle?->title }}</a>
                                                        </p>
                                                    @endif
                                                @empty
                                                    Listelenecek öğe yok
                                                @endforelse
                                                <hr>
                                                @if ($request->teachers->contains(auth()->id()) && $request->teachers->find(auth()->id())->pivot->approved)
                                                    <div class="phone-number">
                                                        Telefon Numarası: {{ $request->student->userDetails->phone }}
                                                    </div>

                                                    <button type="button" class="btn btn-success"
                                                        disabled>Onaylandı</button>
                                                @elseif ($request->approval_count >= 5)
                                                    <button type="button" class="btn btn-success" disabled>Onay Sınırına
                                                        Ulaşıldı</button>
                                                @else
                                                    <button type="button" class="btn btn-info approve-btn"
                                                        data-request-id="{{ $request->id }}">Talebi Onayla / <small
                                                            class="badge bg-primary text-wra">{{ $request->required_credits }}
                                                            TL</small> </button>
                                                @endif

                                                <button type="button" class="btn btn-danger mt-2 remove-btn"
                                                    data-request-id="{{ $request->id }}">İlanı Listemden Kaldır</button>
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    <div class="col-md-12">
                                        <div class="card p-5">Şu Anda Uygun Ders Talebi Bulunmamaktadır...</div>
                                    </div>
                                @endforelse

                            </div>
                        </div>

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

                            toastr.success(response.message);
                            // Öğrenci telefon numarasını al ve göster
                            alert('Öğrenci Telefon Numarası: ' + response.phone);
                            location.reload(); // Sayfayı yenile
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            // İlanı Listeden Kaldır butonu tıklama işlemi
            $('.remove-btn').click(function() {
                var button = $(this);
                var requestId = button.data('request-id');

                // SweetAlert ile onay mesajı göster
                Swal.fire({
                    title: 'Emin misiniz?',
                    text: "Bu ilanı listenizden kaldırmak istediğinizden emin misiniz?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, kaldır!',
                    cancelButtonText: 'Hayır, iptal et!',
                    backdrop: true // Arka planı tamamen pasif hale getirir
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Onaylandıysa AJAX isteği gönder
                        $.ajax({
                            url: '{{ route('lesson-request.remove.teacher') }}',
                            method: 'POST',
                            data: {
                                request_id: requestId,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.status === 200) {
                                    Swal.fire(
                                        'Başarılı!',
                                        response.message,
                                        'success'
                                    );
                                    button.closest('.lesson-request')
                                .remove(); // İlanı DOM'dan kaldır
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
                                    response.message,
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
