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
          <h5 class="card-header">ÖĞRENCİ İLAN SÜRESİ <small class="text-primary"> (Öğrencilerin açtığı ilanların askıda kalma süresi (gün).)</small></h5>
          
          <div class="row card-body mb-3">
           
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    
                    <th>İstek / İlan Türü</th>
                    <th>Geri Sayım Gün Sayısı</th>
                    <th>İşlem</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($durations as $duration)
                    <tr>
                        <td>{{ $duration->request_type}}</td>
                        <td>{{ $duration->duration_days }}</td>
                        
                        <td>
                            
                            <a href="{{ route('request_durations.edit', $duration->id) }}" class="btn btn-warning">Düzenle</a>
                            <button class="btn btn-danger delete-btn" data-id="{{ $duration->id }}">Sil</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr>
        <a href="{{ route('request_durations.create') }}" class="btn btn-primary mb-3 col-lg-3">Yeni Ekle</a>
            
          </div>
          </div>
                
       </div>
    </div>
    </div>
  </div>

@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).ready(function () {
      $('.delete-btn').click(function () {
          var durationId = $(this).data('id');

          Swal.fire({
              title: 'Silmek istediğinizden emin misiniz?',
              text: "Bu işlemi geri alamazsınız!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Evet, Sil!',
              cancelButtonText: 'Hayır, Vazgeç'
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: '/request_durations/' + durationId,
                      type: 'DELETE',
                      data: {
                          "_token": "{{ csrf_token() }}"
                      },
                      success: function (response) {
                          toastr.success('Silme işlemi başarılı.','Başarılı');
                          location.reload();  // Sayfayı yeniler
                      },
                      error: function (response) {
                          toastr.error('İşlem sırasında bir hata oluştu.' ,'Hata!');
                      }
                  });
              }
          });
      });
  });
</script>

@endsection