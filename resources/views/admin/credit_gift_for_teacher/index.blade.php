@extends('master')
@section('title')
    <title> Destek Hoca / Öğretmene Kredi Gönder </title>
@endsection

@section('css')
@endsection




@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->
    
    <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

        <div class="col-md-12">


            <div class="card mb-4">
                <h5 class="card-header">ÖĞRETMENLERE KREDİ GÖNDER</h5>
                {{-- Öğretmen Arama --}}
                <div class="row card-body mb-3">
                    <form method="GET" action="">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Ara... İsim yada Email adresi yazın"
                                    value="{{ request()->query('search') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary"> <i
                                        class="bx bx-search fs-4 lh-0"></i></button>
                            </div>
                        </div>
                    </form>

                    <div class="col-lg-12 mb-4 mb-xl-0">
                        <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" class="col-1">Resim</th>
                                        <th scope="col" class="col-2">Öğretmen Adı Soyadı</th>
                                        <th scope="col" class="col-3">Cüzdan Bakiyesi</th>
                                        <th scope="col" class="col-2">Hediye Miktarı</th>
                                        <th scope="col" class="col-2">İşlem</th>

                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">

                                    @forelse ($teachers as $teacher)
                                        <tr>
                                            <td>
                                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                                 <li
                                                    data-bs-toggle="tooltip"
                                                    data-popup="tooltip-custom"
                                                    data-bs-placement="top"
                                                    class="avatar avatar-xs pull-up"
                                                    title="{{ $teacher->name }} {{ $teacher->surname }}">
                                                    <img src="{{asset('backend/assets')}}/img/profileimages/{{ $teacher->userDetails->profile_image ?: '/no_image.jpg' }}" alt="Avatar" class="w-px-40 h-px-40 rounded-circle" />
                                                  </li>
                                                </ul>
                                              </td>
                                            <td>{{ $teacher->name }} {{ $teacher->surname }}</td>
                                            <td>{{ $teacher->wallet->balance }} TL</td>
                                            <td>
                                                <input class="form-control" type="number" id="credit_{{ $teacher->id }}"
                                                    placeholder="Kredi Miktarı" min="1">
                                            </td>
                                            <td>
                                                <button class="form-control btn-primary send-credit" data-id="{{ $teacher->id }}">Gönder</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Kayıtlı Öğretmen Bulunamadı...</td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                            <hr>
                            {{ $teachers->links() }}  <!-- Sayfalama ve arama terimini koruma -->


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).on('click', '.send-credit', function() {
            var teacherId = $(this).data('id');
            var amount = $('#credit_' + teacherId).val();

            if (amount < 0) {
                toastr.warning('Lütfen hediye miktarını eksi değer girmeyiniz');
                return;
            }else if(amount == ''){
                toastr.warning('Lütfen hediye miktarını boş bırakmayınız');
                return;
            }

            Swal.fire({
                title: 'Emin misiniz?',
                text: amount + ' TL kredi göndermek üzeresiniz!',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                showCancelButton: true,
                confirmButtonText: 'Evet, Gönder!',
                cancelButtonText: 'Hayır, İptal Et'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('admin.credit.gift.add.money') }}",
                        method: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            teacher_id: teacherId,
                            amount: amount
                        },
                        success: function(response) {
                            Swal.fire('Başarılı!', response.success, 'success');
                            setTimeout(() => {
                                location.reload(); // Sayfayı yenile
                            }, 1000); // 1 saniye bekleme süresi
                        },
                        error: function(xhr) {
                            //Swal.fire('Hata!', 'Kredi gönderilemedi.', 'error');
                            let errors = xhr.responseJSON.errors;
                let errorMessage = '';

                $.each(errors, function(key, value) {
                    errorMessage += value + '<br>';
                });

                $('#error-message').html(errorMessage).show(); // Hata mesajlarını göster
                        }
                    });
                }
            });
        });
    </script>
@endsection
