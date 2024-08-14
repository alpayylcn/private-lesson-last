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
                            <h3 class="bg-warning text-white border rounded p-4 col-lg-12">Cüzdan Bakiyeniz : <span class="text-danger fs-2">{{$balance}}</span> TL</h3>
                            {{-- <h3 class="btn btn-primary text-white p-4 col-lg-4 fs-4">Bakiye Yükle </h3> --}}
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
                <div class="card-header">İlan Vermenin Size Faydası Nedir?</div>
                <div class="card-body">
                    
                </div>
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
