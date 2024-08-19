@extends('master')
@section('title')
    <title> Destek Hoca / İlan Fiyat Güncelleme </title>
@endsection

@section('css')
@endsection



@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        
        <div class="row">
            <!-- Existing Durations Table -->
            <div class="col-lg-6">
                <div class="bg-white p-5 rounded-md shadow-sm">
                    <h3 class="text-2xl font-bold mb-2">İlan Seçenekleri</h3>
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
                            @foreach($durations as $duration)
                                <tr data-id="{{ $duration->id }}">
                                    <td>{{ $duration->name }}</td>
                                    <td>{{ $duration->days }}</td>
                                    <td>{{ $duration->price }} TL</td>
                                    <td>
                                        <button class="edit-btn bg-warning hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" data-id="{{ $duration->id }}">Düzenle</button>
                                        <button class="delete-btn bg-danger hover:bg-red-700 text-white font-bold py-1 px-2 rounded" data-id="{{ $duration->id }}">Sil</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="success-message" class="hidden bg-green-500 text-white p-2 rounded-md mb-4"></div>
                    
                    </div>
                </div>
            

            <!-- Create/Edit Duration Form -->
            <div class="col-lg-6">
                <div class="bg-white p-5 rounded-md shadow-sm">
                    <h3 class="text-2xl font-bold mb-2" id="form-title">Yeni İlan Ekle</h3>

                    <form id="duration-form">
                        @csrf
                        <input type="hidden" id="duration-id">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold " for="name">
                                İlan Adı:
                            </label><br>
                            <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold " for="days">
                                Gün Sayısı:
                            </label><br>
                            <input type="number" name="days" id="days" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold " for="price">
                                Ücret:
                            </label><br>
                            <input type="number" name="price" id="price" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        </div>

                        <div class="flex items-center justify-between">
                            <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Kaydet
                            </button>
                        </div>
                    </form>
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
                    $('#success-message').text('İlan Bilgileri Kaydedildi.').removeClass('hidden');

                    if (id) {
                        // Update existing row
                        $('tr[data-id="'+id+'"]').find('td:nth-child(1)').text(response.name);
                        $('tr[data-id="'+id+'"]').find('td:nth-child(2)').text(response.days);
                        $('tr[data-id="'+id+'"]').find('td:nth-child(3)').text(response.price + ' TL'); 
                        toastr.success('İlan Bilgileri Güncellendi.');
                    } else {
                        // Add new row
                        let newRow = '<tr data-id="'+response.id+'"><td>'+response.name+'</td><td>'+response.days+'</td><td>'+response.price+' TL</td><td><button class="edit-btn bg-warning hover:bg-blue-700 text-white font-bold py-1 px-2 rounded" data-id="'+response.id+'">Düzenle</button> <button class="delete-btn bg-danger hover:bg-red-700 text-white font-bold py-1 px-2 rounded" data-id="'+response.id+'">Sil</button></td></tr>';
                        $('#durations-table tbody').append(newRow);
                        toastr.success('İlan Ekleme Başarılı.');
                    }

                    $('#duration-form')[0].reset();
                    $('#form-title').text('Yeni İlan Ekle');
                    $('#duration-id').val('');
                },
                error: function() {
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
                }, error: function() {
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
                                $('tr[data-id="'+id+'"]').remove();
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
</script>
@endsection

