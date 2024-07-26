@extends('master')
@section('title')
    <title> Destek Hoca / Uzman Öğretmeler </title>
@endsection

@section('css')
@endsection



@section('content')

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="col-lg-12 mb-3">
            <div class="card">
                <div class="card-header">Kredi Ayarları</div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('admin.credit-settings.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="weekly_credits" class="form-label">Haftalık İlan Kredi Miktarı</label>
                                <input type="number" class="form-control" id="weekly_credits" name="weekly_credits" value="{{ $creditSetting->weekly_credits }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="monthly_credits" class="form-label">Aylık İlan Kredi Miktarı</label>
                                <input type="number" class="form-control" id="monthly_credits" name="monthly_credits" value="{{ $creditSetting->monthly_credits }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="yearly_credits" class="form-label">Yıllık İlan Kredi Miktarı</label>
                                <input type="number" class="form-control" id="yearly_credits" name="yearly_credits" value="{{ $creditSetting->yearly_credits }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="first_offer" class="form-label">İlk Teklif Kredi Miktarı</label>
                                <input type="number" class="form-control" id="first_offer" name="first_offer" value="{{ $creditSetting->first_offer }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="second_offer" class="form-label">İkinci Teklif Kredi Miktarı</label>
                                <input type="number" class="form-control" id="second_offer" name="second_offer" value="{{ $creditSetting->second_offer }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="third_offer" class="form-label">Üçüncü Teklif Kredi Miktarı</label>
                                <input type="number" class="form-control" id="third_offer" name="third_offer" value="{{ $creditSetting->third_offer }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="fourth_offer" class="form-label">Dördüncü Teklif Kredi Miktarı</label>
                                <input type="number" class="form-control" id="fourth_offer" name="fourth_offer" value="{{ $creditSetting->fourth_offer }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="fifth_offer" class="form-label">Beşinci Teklif Kredi Miktarı</label>
                                <input type="number" class="form-control" id="fifth_offer" name="fifth_offer" value="{{ $creditSetting->fifth_offer }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Kaydet</button>
                        </form>
                    </div>
                        <div class="col-lg-6 mt-4">
                            Kayıtlı öğretmenlerin ilan verirken ve gelen ders taleplerinde telefon numarası görmek için ödemeleri gereken kredi miktarlarını belirleyiniz.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection





@section('js')
@endsection

