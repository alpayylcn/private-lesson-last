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
  
  <div class="col-md-12">
    
    
        <div class="card mb-4">
          <h5 class="card-header">ÖĞRENCİ İLAN SÜRESİ GÜNCELLEME <small class="text-primary"> (Öğrencilerin açtığı ilanların askıda kalma süresi (gün).)</small></h5>
          
          <div class="row card-body mb-3">
           
            <form action="{{ route('request_durations.update', $requestDuration->id) }}" method="POST">
              @csrf
              @method('PUT')
              <div class="form-group">
                  <label for="request_type">İlan Türü</label>
                  <input type="text" class="form-control" id="request_type" name="request_type" value="{{ $requestDuration->request_type }}" required>
              </div>
              <div class="form-group mt-2">
                  <label for="duration_days ">Yayında Kalma Süresi</label>
                  <input type="number" class="form-control" id="duration_days" name="duration_days" value="{{ $requestDuration->duration_days }}" required>
              </div>
              <button type="submit" class="btn btn-primary mt-2">Güncelle</button>
          </form>
       
            
          </div>
          </div>
                
       </div>
    </div>
    </div>
  </div>

@endsection

@section('js')


@endsection