@extends('master')
@section('title')
    <title> Destek Hoca / Ders Ekle Sil </title>
@endsection

@section('css')
@endsection




@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                {{-- Öğrenci İlan Süresi --}}
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">ÖĞRENCİ İLAN SÜRESİ <small class="text-primary"> (Öğrencilerin açtığı
                                ilanların askıda kalma süresi (gün).)</small></h5>
                        <div class="row card-body mb-3">
                            <table class="table">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>Öğrencinin Verdiği İlanın Otomatik Silineceği Gün Sayısı</td>
                                        <td>
                                            <input type="text" class="form-control" name="duration_days"
                                                id="duration_days" value="{{ $requestDurationDay->duration_days }}">
                                        </td>
                                        <td><input type="hidden" name="duration_id" id="duration_id"
                                                value="{{ $requestDurationDay->id }}"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary mt-2"
                                                id="updateDuration">Güncelle</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- TL Yükleme Üst Sınırı --}}
                <div class="col-md-6">
                    <div class="card mb-4">
                        <h5 class="card-header">TL Yükleme Üst Sınırı <small class="text-primary"> </small></h5>
                        <div class="row card-body mb-3">
                            <table class="table">
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <td>TL Yükleme Üst Sınırı</td>
                                        <td>
                                            <input type="text" class="form-control" name="duration_days"
                                                id="depositLimit_input" value="{{ $depositLimit?->limit }}">
                                        </td>
                                        <td><input type="hidden" name="depositLimit_id" id="depositLimit_id"
                                                value="{{ $depositLimit?->id }}"></td>
                                        <td>
                                            <button type="button" class="btn btn-primary mt-2"
                                                id="depositLimit">Güncelle</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- Öğretmenin verdiği ilan ücretleri --}}
                <div class="col-md-12 ">
                    <div class="card mb-4 ">
                        <div class="row">
                            <div class="col-md-6">

                                <h5 class="card-header">İlan Ücretleri <small class="text-primary"> </small></h5>
                                <div class="row card-body mb-3">

                                    <table class=" table table-auto w-full" id="durations-table">
                                        <thead>
                                            <tr>
                                                <th>İlan Adı</th>
                                                <th>Gün Sayısı</th>
                                                <th>Ücret</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($durations as $duration)
                                                <tr data-id="{{ $duration->id }}">
                                                    <td>{{ $duration->name }}</td>
                                                    <td>{{ $duration->days }}</td>
                                                    <td>{{ $duration->price }} TL</td>
                                                    <td>
                                                        <button
                                                            class="edit-btn bg-warning hover:bg-blue-700 text-white font-bold py-1 px-2 rounded"
                                                            data-id="{{ $duration->id }}">Düzenle</button>
                                                        <button
                                                            class="delete-btn bg-danger hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                                            data-id="{{ $duration->id }}">Sil</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>


                                </div>
                            </div>

                            <div class="col-md-6 px-4 ">
                                <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
                                <!-- Hata mesajları burada gösterilecek -->

                                <h5 class="card-header">Yeni İlan Bilgisi Ekle <small class="text-primary"> </small></h5>
                                <form id="duration-form">
                                    @csrf
                                    <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                                    <input type="hidden" id="duration-id">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold " for="name">
                                            İlan Adı:
                                        </label><br>
                                        <input type="text" name="name" id="name"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            required>
                                    </div>

                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold " for="days">
                                            Gün Sayısı:
                                        </label><br>
                                        <input type="number" name="days" id="days"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            required>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm font-bold " for="price">
                                            Ücret:
                                        </label><br>
                                        <input type="number" name="price" id="price"
                                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                            required>
                                    </div>

                                    <div class="flex items-center justify-between">
                                        <button type="submit"
                                            class="mb-2 bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                            Kaydet
                                        </button>
                                    </div>
                                    <hr>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Teklif Sayı sıra ve Ücretleri --}}
                




                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Teklif Ücretleri<small class="text-primary"> </small></h5>
                        <div class="row card-body mb-3">
                            
                            <div id="successMessage"></div>
                            <div class="col-lg-6">
                            <table class="table table-auto w-full" id="offersTable">
                                <thead>
                                    <tr>
                                        <th>Teklif Sırası</th>
                                        <th>Teklif Fiyatı</th>
                                        <th>Güncelle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teacherOfferOrder as $offer)
                                        <tr data-id="{{ $offer->id }}">
                                            <td>{{ $offer->offer_order }}. Teklif</td>
                                            <td>
                                                <input type="number" class="offer-price form-control" value="{{ $offer->offer_price }}">
                                            </td>
                                            <td>
                                                <button class="updateOfferButton form-control bg-warning text-white">Güncelle</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                            
                            <div class="col-lg-6 ">
                                <form id="addOfferForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-4 mt-3">
                                            <input type="number" class="form-control col-lg-4" name="offer_price" id="offer_price" placeholder="Teklif Fiyatı" required>
                                        </div>
                                        <div class="col-lg-4 mt-3">
                                            <button type="button" id="addOfferButton" class="form-control btn-primary col-lg-4">Teklif Ekle</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-lg-8 mt-3">
                                <button id="deleteLastOfferButton" class="form-control bg-danger text-white">Son Teklifi Kaldır</button>
                                </div>

                           </div>

                        </div>
                    </div>
                </div>
                
                
                
                
                
                
                <div class="col-md-12">
                    <div class="card mb-4">
                        <h5 class="card-header">....<small class="text-primary"> </small></h5>
                        <div class="row card-body mb-3">

                        </div>
                    </div>
                </div>




            </div>
        </div>


    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        // Öğrenci ilan sürelerinin belirlenmesi
        $(document).ready(function() {
            $('#updateDuration').click(function() {
                let durationDays = $('#duration_days').val();
                let durationId = $('#duration_id').val();

                $.ajax({
                    url: '{{ route('admin.requestDuration.update') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        duration_days: durationDays,
                        duration_id: durationId,
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Süre başarıyla güncellendi');
                        } else {
                            toastr.error('Bir hata oluştu');
                        }
                    },
                    error: function() {
                        toastr.error('Güncelleme işlemi başarısız oldu');
                    }
                });
            });
        });


        // Para Üst Limiti Güncelleme
        $(document).ready(function() {
            $('#depositLimit').click(function() {
                let depositLimit = $('#depositLimit_input').val();
                let depositLimitId = $('#depositLimit_id').val();

                $.ajax({
                    url: '{{ route('admin.depositLimit.update') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        deposit_limit: depositLimit,
                        deposit_limit_id: depositLimitId,
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Para üst sınırı başarıyla güncellendi');
                        } else {
                            toastr.error('Bir hata oluştu');
                        }
                    },
                    error: function() {
                        toastr.error('Güncelleme işlemi başarısız oldu');
                    }
                });
            });
        });


        // Öğretmen İlan ücretleri scripti

        $(document).ready(function() {
            $('#duration-form').on('submit', function(event) {
                event.preventDefault();

                let id = $('#duration-id').val();
                let name = $('#name').val();
                let days = $('#days').val();
                let price = $('#price').val();
                let url = "{{ route('durations.store') }}";
                let method = 'POST';

                if (id) {
                    url = "{{ route('durations.update', '') }}/" + id;
                    method = 'PUT';
                }

                $.ajax({
                    url: url,
                    method: method,
                    data: {
                        _token: "{{ csrf_token() }}",
                        name: name,
                        days: days,
                        price: price,
                    },
                    success: function(response) {
                        $('#success-message').text('İlan Bilgileri Kaydedildi.').removeClass(
                            'hidden');

                        if (id) {
                            // Update existing row
                            $('tr[data-id="' + id + '"]').find('td:nth-child(1)').text(response
                                .name);
                            $('tr[data-id="' + id + '"]').find('td:nth-child(2)').text(response
                                .days);
                            $('tr[data-id="' + id + '"]').find('td:nth-child(3)').text(response
                                .price + ' TL');
                            toastr.success('İlan Bilgileri Güncellendi.');
                        } else {
                            // Add new row
                            let newRow = '<tr data-id="' + response.id + '"><td>' + response
                                .name + '</td><td>' + response.days + '</td><td>' + response
                                .price +
                                ' TL</td><td><button class="edit-btn bg-warning hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" data-id="' +
                                response.id +
                                '">Düzenle</button> <button class="delete-btn bg-danger hover:bg-red-700 text-white font-bold py-1 px-2 rounded" data-id="' +
                                response.id + '">Sil</button></td></tr>';
                            $('#durations-table tbody').append(newRow);
                            toastr.success('İlan Ekleme Başarılı.');
                        }

                        $('#duration-form')[0].reset();
                        $('#form-title').text('Yeni İlan Ekle');
                        $('#duration-id').val('');
                        $('#error-message').hide(); // Hata mesajlarını gizle
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        $.each(errors, function(key, value) {
                            errorMessage += value + '<br>';
                        });

                        $('#error-message').html(errorMessage)
                    .show(); // Hata mesajlarını göster
                        toastr.error('İşlem Sırasında Bir Hata Oluştu.');
                    }
                });
            });


            $(document).on('click', '.edit-btn', function() {
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('durations.show', '') }}/" + id,
                    method: 'GET',
                    success: function(response) {
                        $('#form-title').text('Başlığı Düzenle');
                        $('#duration-id').val(response.id);
                        $('#name').val(response.name);
                        $('#days').val(response.days);
                        $('#price').val(response.price);
                    },
                    error: function() {
                        toastr.error('Bilgiler Alınırken Bir Hata Oluştu.');
                    }
                });
            });

            $(document).on('click', '.delete-btn', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: 'Silmek İstediğinize Emin Misiniz?',
                    text: "Bu İşlem Geri Alınamaz!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Evet, Sil!',
                    cancelButtonText: 'Hayır, İptal Et'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('durations.destroy', '') }}/" + id,
                            method: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('tr[data-id="' + id + '"]').remove();
                                    Swal.fire(
                                        'Silindi!',
                                        'İlan Bilgileri Silindi.',
                                        'Başarılı'
                                    );
                                } else {
                                    Swal.fire(
                                        'Silinemedi!',
                                        'Silme İşlemi Yapılırken Bir Hata Oluştu.',
                                        'Hata'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Silinemedi!',
                                    'Silme İşlemi Yapılırken Bir Hata Oluştu.',
                                    'Hata'
                                );
                            }
                        });
                    }
                });
            });
        });


//Teklif Ücretleri scripti
        $(document).ready(function() {
    // Teklif Ekleme
    $('#addOfferButton').on('click', function() {
        var offerPrice = $('#offer_price').val();
        $.ajax({
            url: '{{ route('teacher_offer_order_and_prices.store') }}',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                offer_price: offerPrice
            },
            success: function(response) {
                $('#successMessage').html('<div class="alert alert-success">Teklif başarıyla eklendi.</div>');
                $('#addOfferForm')[0].reset();
                setTimeout(function() {
                            location.reload();
                }, 1000);
            },
            // error: function(xhr) {
            //     var errorMessage =xhr.errorMessage;
            //     $('#successMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>');
            // }

            error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMessage = '';

                        $.each(errors, function(key, value) {
                            errorMessage += value + '<br>';
                        });

                        $('#successMessage').html('<div class="alert alert-danger">' + errorMessage + '</div>')
                    .show(); // Hata mesajlarını göster
                    }
        });
    });

    // Teklif Güncelleme
    $('#offersTable').on('click', '.updateOfferButton', function() {
        var row = $(this).closest('tr');
        var id = row.data('id');
        var offerPrice = row.find('.offer-price').val();
        
        $.ajax({
            url: '{{ route('teacher_offer_order_and_prices.update', '') }}/' + id,
            type: 'PUT',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                offer_price: offerPrice
            },
            success: function(response) {
                Swal.fire('Güncellendi!', 'Teklif başarıyla güncellendi.', 'success');
            },
            error: function(xhr) {
                Swal.fire('Hata!', 'Bir hata oluştu.', 'error');
            }
        });
    });

    // Son Teklifi Kaldırma
    $('#deleteLastOfferButton').on('click', function() {
    Swal.fire({
        title: 'Emin misiniz?',
        text: "Son teklifi kaldırmak üzeresiniz!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Evet, Kaldır!',
        cancelButtonText: 'Hayır, İptal!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '{{ route('teacher_offer_order_and_prices.destroy') }}',
                type: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire('Silindi!', 'Son teklif başarıyla kaldırıldı.', 'success');
                    location.reload();
                    
                },
                error: function(xhr) {
                    Swal.fire('Hata!', 'Bir hata oluştu.', 'error');
                }
            });
        }
    });
});

   
});

 



    </script>
@endsection
