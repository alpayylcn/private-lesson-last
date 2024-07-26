@extends('master')
@section('title')
    <title> Destek Hoca / Uzman Öğretmeler </title>
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
            <div class="col-md-6 col-lg-4 mb-3">
              <div class="card">
                <div class="card-header">Ders Adı</div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-4 text-center">
                      <img src="profile.jpg" class="rounded-circle" alt="Öğretmen Profili" width="50">
                      <h6 class="mt-2">Öğretmen A.</h6>
                    </div>
                    <div class="col-8">
                      <p class="card-text">Kısa Bilgi</p>
                      <p class="card-text"><small class="text-muted">Şehir: Öğretmenin Şehri</small></p>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="row">
                    <div class="col-6">
                      <p class="mb-0"><i class='bx bxs-star text-warning'></i> 4.5</p>
                      <p class="mb-0"><small>(20 yorum)</small></p>
                    </div>
                    <div class="col-6 text-end">
                      <p class="mb-0">50 TL/Saat</p>
                      <a href="javascript:void(0)" class="btn btn-primary btn-sm mt-2">Ders Talebi Gönder</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div>
    </div>
@endsection

@section('js')
    {{-- Öğretmen onaylama işlemi --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/js/bootstrap-switch.min.js"></script>


    <script>
        $(document).ready(function() {
            $(".approve-switch").bootstrapSwitch({
                onColor: 'success',
                offColor: 'danger',
                onText: '<i class="bx bx-check-circle me-1">',
                offText: '<i class="bx bx-stop-circle me-1"></i>',
                size: 'small'
            });

            $('.approve-switch').on('switchChange.bootstrapSwitch', function(event, state) {
                var teacherId = $(this).data('id');
                var approved = state ? 1 : 0;
                $.ajax({
                    url: '{{ route('admin.teacherList.approved') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: teacherId,
                        approved: approved
                    },
                    success: function(response) {
                        if (response.success) {
                            if (state) {
                                toastr.success('Öğretmen Onaylandı.');
                            } else {
                                toastr.warning('Öğretmen Onayı İptal Edildi.');
                            }
                        } else {
                            toastr.error('Onay işlemi sırasında bir hata oluştu.');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        toastr.error('Onay işlemi sırasında bir hata oluştu.');
                    }
                });
            });
        });
    </script>
@endsection
