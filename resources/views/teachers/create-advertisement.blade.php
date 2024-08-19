@extends('master')
@section('title')
    <title> Destek Hoca / Uzman Öğretmeler </title>
@endsection

@section('css')
<style>
    .radio-card {
        display: flex;
        justify-content: space-between;
    }
    .radio-card .card {
        flex: 1;
        margin: 0 5px;
        text-align: center;
    }
    .radio-card .card input {
        display: none;
    }
    .radio-card .card label {
        display: block;
        padding: 20px;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .radio-card .card input:checked + label {
        background-color: #007bff;
        color: white;
    }
    .radio-card .card:nth-child(1) label {
        background-color: #f8d7da;
    }
    .radio-card .card:nth-child(2) label {
        background-color: #d1ecf1;
    }
    .radio-card .card:nth-child(3) label {
        background-color: #d4edda;
    }
    .radio-card .card:nth-child(4) label {
        background-color: #f0d967;
    }
    .btn-wide {
            width: 100%;
            padding: 15px 0;
        }

        .amount-card {
    cursor: pointer;
    border: 2px solid transparent;
    transition: transform 0.3s ease, border-color 0.3s ease;
}

.amount-card[data-value="250"] {
    background-color: #f0f8ff;
}

.amount-card[data-value="500"] {
    background-color: #e6ffe6;
}

.amount-card[data-value="750"] {
    background-color: #fff0f5;
}

.amount-card[data-value="1000"] {
    background-color: #ffffe0;
}

.amount-card:hover {
    transform: scale(1.05);
}

.amount-card.active {
    border-color: #007bff;
    transform: scale(1.1);
}

.amount-card.active .card-body {
    font-weight: bold;
    color: #007bff;
}
</style>
@endsection




@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
   <div class="row">
            <div class="col-md-12 col-lg-6 mb-3">
                <div class="card">
                    <div class="card-header"><h3>İlan Ver</h3> </div>
                    <div class="card-body">
                        <div class="row">
                            <h3 class="bg-warning text-white border rounded p-4 col-lg-12">
                                Cüzdan Bakiyeniz : <span class="text-danger fs-2">{{$balance}}</span> TL
                                <button class="btn btn-sm btn-light float-end" id="topUpButton" data-bs-toggle="modal" data-bs-target="#topUpModal">TL Yükle</button>
                            </h3>
                            
                        </div>
                        <form id="advertisementForm">
                            @csrf
                            <div class="mb-3 mt-3"><hr>
                                <label class="form-label">Ne Kadar Süreyle İlan Vermek İstiyorsunuz?</label>
                                <div class="radio-card">
                                    @foreach($durations as $duration)
                                        <div class="card">
                                            <input class="form-check-input" type="radio" name="duration_id" id="duration{{ $duration->id }}" value="{{ $duration->id }}" required>
                                            <label class="form-check-label" for="duration{{ $duration->id }}">
                                                {{ $duration->name }}<br> ({{ round($duration->price,0) }} TL)
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <hr>
                            <div class="mb-3">
                                {{-- <label for="reason" class="form-label">Harcama Nedeni</label> --}}
                                <select class="form-select" id="reason_id" hidden name="reason_id" required>
                                    @foreach($reasons as $reason)
                                        <option value="{{ $reason->id }}">{{ $reason->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-wide">İlan Ver</button>
                        </form>
            </div>
                </div>
            </div>

        <div class="col-md-12 col-lg-6 mb-3">
            <div class="card">
                <div class="card-header"><h3>Aktif İlanlarınız</h3> </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>İlan</th>
                                    <th>Süre (Gün)</th>
                                    <th>Durum</th>
                                    <th>Kalan Gün Sayısı</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($advertisements as $advertisement)
                                    <tr>
                                        <td>{{ $advertisement->duration->name }}</td>
                                        <td>{{ $advertisement->duration->days }}</td> <!-- Süreyi durations tablosundan alıyoruz -->
                                        <td>{{ $advertisement->approved ? 'Onaylandı' : 'Onay Bekliyor' }}</td>
                                        <td>{{ $advertisement->remaining_days }}</td> 
                                        
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <div class="card-header"><b>İlan Vermenin Size Faydası Nedir?</b> </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
        </div>

    </div>


<!-- TL Yükleme Modalı -->
<div class="modal fade" id="topUpModal" tabindex="-1" aria-labelledby="topUpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="topUpModalLabel">Cüzdanınıza TL Yükleyin</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="topUpForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="card amount-card" data-value="250">
                                <div class="card-body text-center">
                                    <h5>250 TL</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card amount-card" data-value="500">
                                <div class="card-body text-center">
                                    <h5>500 TL</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card amount-card" data-value="750">
                                <div class="card-body text-center">
                                    <h5>750 TL</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="card amount-card" data-value="1000">
                                <div class="card-body text-center">
                                    <h5>1000 TL</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="customAmount" class="form-label">Özel Miktar Belirtin</label>
                        <input type="number" class="form-control" id="customAmount" placeholder="Miktar girin">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Yükle</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script>
    $(document).ready(function() {
        $('#advertisementForm').on('submit', function(e) {
            e.preventDefault();
    
            $.ajax({
                url: "{{ route('teachers.spend-credits') }}",
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    duration_id: $('input[name="duration_id"]:checked').val(),
                    reason_id: $('#reason_id').val()
                },
                success: function(response) {
                    toastr.success(response.message);
                    setTimeout(() => {
                        location.reload(); // Sayfayı yenile
                    }, 1000); // 1 saniye bekleme süresi
                },
                error: function(xhr) {
                    var response = JSON.parse(xhr.responseText);
                    toastr.error(response.message);
                }
            });
        });
    });
  

//Para yükleme Scripti
$(document).ready(function() {
    $('.amount-card').click(function() {
        $('.amount-card').removeClass('active');
        $(this).addClass('active');
        $('#customAmount').val(''); // Özel miktar alanını temizle
    });

    $('#customAmount').on('input', function() {
        $('.amount-card').removeClass('active'); // Radyo butonlarını devre dışı bırak
    });

    $('#topUpForm').submit(function(e) {
        e.preventDefault();

        var selectedAmount = $('.amount-card.active').data('value');
        var customAmount = $('#customAmount').val();

        var amount = customAmount ? customAmount : selectedAmount;

        if (!amount) {
            alert('Lütfen bir miktar seçin veya girin.');
            return;
        }

        $.ajax({
            url: '{{route("add.money.store")}}', // Backend route
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                amount: amount
            },
            success: function(response) {
                toastr.success('Yükleme başarılı! Güncel bakiye: ' + response.balance + ' TL');
                $('#topUpModal').modal('hide');
                location.reload(); // Sayfayı yeniden yükle
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                toastr.error(response.message); // Hata mesajını gösterin
            }
        });
    });
});
</script>
@endsection
