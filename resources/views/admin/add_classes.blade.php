@extends('master')
@section('title')
<title> Destek Hoca / Sınıf Ekle Sil </title>
@endsection

@section('css')
   
@endsection




@section('content')
   
<!-- Content wrapper -->
<div class="content-wrapper">
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
{{-- Top Buttons Start --}}
@include('admin.layout.top_buttons')
{{-- Top Buttons End --}}

<div class="row">
  
  <div class="col-md-12">
    {{-- Top Buttons Start --}}
      @include('admin.layout.tabs_lesson_and_class')
    {{-- Top Buttons End --}}
    @if($errors->has('any'))
    @foreach ($errors->get('all') as $error)
      <div class="alert alert-danger col-lg-9">{{ $error }}</div>
    @endforeach
  @endif
    <div class="card mb-4">
      <h5 class="card-header">SINIF/KURS/GRUP EKLEME <small>(11. Sınıf, 12. Sınıf, LGS, TYT vs.)</small></h5>
      
      <div class="row card-body mb-3">
        <div class="col-lg-4">
          <form method="POST" action="{{route('classes.addClassesStore')}}" enctype="multipart/form-data">
            @csrf 
            <input type="hidden" name="add_user_id" value="{{$id}}">
            <small class="text-light fw-semibold"> "Sınıf Ekle" butonuna basarak ders ekleyebilirsiniz.</small>
            <div class="row">
             <div class="col-lg-7"><input type="text" name="title" class="form-control" placeholder="Sınıf Adı" required></div>
             <div class="col-lg-5 mb-3"><button type="submit" id="submit" class="btn btn-primary me-2">SINIF EKLE</button> </div>   
            </div>
              </form>   
              </tr>
              
        </div>

        <div class="col-lg-4 mb-4 mb-xl-0">
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col" class="col-4">Aktif Sınıflar</th>
                    <th scope="col" class="col-5">İşlem</th>
                    <th scope="col" class="col-3"></th>
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  @forelse ($classData as $class)
                    @if(!$class->trashed())
                    <tr>
                      <td class="p-2"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$class->title}} </strong></td>
                      <td class="p-2">
                        <button type="button"  id="{{$class->id}}" class="btn btn-link text-warning btnclssdelete"><i class="bx bx-show-alt me-1"></i> Pasife Al</button>
                      </td>
                      @if (!$class->hasClass())
                      <td class="p-2">
                        <button type="button"  id="{{$class->id}}" class="btn btn-link text-danger btnclssforcedelete"><i class="bx bx-trash me-1"></i> Sil</button>
                      </td>
                      @endif
                      <td class="p-2"><input type="hidden" name="lesson_id" value="{{$class->id}}"></td>
                    </tr>
                  @endif
                  @empty
                    <td class="p-2">Sınıf bulunamadı</td>
                  @endforelse
                  
                </tbody>
              </table>
            </div>
        </div>
        
        <div class="col-lg-4 mb-4 mb-xl-0">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="col-4">Pasif Sınıflar</th>
                  <th scope="col" class="col-5">İşlem</th>
                  <th scope="col" class="col-3"></th>
              </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                
               
                @php $index = 0; @endphp
                @forelse ($classDataTrashed as $index=> $class)
                  <tr>
                    <td class="p-2"><strong>{{$class->title}} </strong></td>
                    <td class="p-2"><button type="button"  id="{{$class->id}}" class="btn btn-link text-info btnclssrestore"><i class="bx bx-show me-1"></i> Aktif Et</button></td>
                    @if (!$class->hasClass())
                    <td class="p-2"><button type="button"  id="{{$class->id}}" class="btn btn-link text-danger btnclssforcedelete"><i class="bx bx-trash me-1"></i> Sil</button></td>
                    @endif
                  </tr>
              
                @empty
                <td class="p-2">Pasif Sınıf Bulunamadı</td>
                @endforelse
               
              @if ($index!=0)
              <tr>
                <td colspan="3"><button type="button" class="btn btn-link text-danger btnclssforcedelete">
                  <i class="bx bx-trash me-1"></i> Bütün Pasif Sınıfları Tamamen Sil</button>
                </td>
              </tr>
              @endif
              </tbody>
            </table>
        </div>
      </div>
      </div>
            <div class="card mb-4">
              <div class="card-body">
                <div class="mt-2">
                   
                  <div id="defaultFormControlHelp" class="form-text">
                    Gönder butonuna bastığınızda verdiğiniz bilgilerin doğruluğunu onaylamış olursunuz.
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

<script>
   $('.btnclssdelete').click(function() {
var id = $(this).attr('id');
  
    Swal.fire({
          title: 'Sınıfı Pasif Yapmak Üzeresin',
          text: "Bunu Yapmak İstediğine Emin Misin?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Evet',
          cancelButtonText: 'Hayır'
      }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
                  type: "post",
                  url: "{{route('classes.deleteClasses')}}",
                  data:{_token:"{{ csrf_token() }}",id:id},
                  success: function(msg) {
                        if (msg) {
                            Swal.fire(
                                'Pasif Hale Getirildi!',
                                'İşleminiz Başarılı Bir Şekilde Gerçekleştirildi.',
                                'success'
                            );
                            setTimeout(function() {
                                window.location.reload(1);
                            }, 1000);
                        }
                    },
                    error: function(xhr, status, error) {
                        // Hata durumunda SweetAlert2 ile bir hata mesajı gösterilebilir
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: 'Üzgünüz İşleminiz gerçekleştirilemedi.'
                        });
                    }
              });
          }
 });
});
</script>

<script>
  $('.btnclssrestore').click(function() {
    var id = $(this).attr('id');
    
        Swal.fire({
            title: 'Sınıf Aktif Hale Gelecek',
            text: "Bunu Yapmak İstediğine Emin Misin?",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet Getir',
            cancelButtonText: 'Hayır'
      }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({  
                    type: "post",
                    url: "{{route('classes.restoreClasses')}}",
                    data:{_token:"{{ csrf_token() }}",id:id},
                    success: function(msg) {
                    if (msg) {
                      Swal.fire(
                        'Sınıf Aktifleştirildi!',
                        'İşleminiz Başarılı Bir Şekilde Gerçekleştirildi.',
                        'success'
                    );
                        setTimeout(function(){
                        window.location.reload(1);
                        }, 1000);
  
                        }
                    },
                    error: function(xhr, status, error) {
                        // Hata durumunda SweetAlert2 ile bir hata mesajı gösterilebilir
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: 'Üzgünüz İşleminiz gerçekleştirilemedi.'
                        });
                    }
        });
   }
});
  });
</script>

<script>
  $('.btnclssforcedelete').click(function() {
    var id = $(this).attr('id');
    Swal.fire({
            title: 'Tamamen Silmek Üzeresin',
            text: "Bu İşlem Geri Alınamaz",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet Sil',
            cancelButtonText: 'Hayır Vazgeç'
        }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                    type: "post",
                    url: "{{route('classes.forceDeleteClasses')}}",
                    data:{_token:"{{ csrf_token() }}",id:id},
                    success: function(msg) {
                    if (msg) {
                      Swal.fire(
                      'Silindi!',
                      'İşleminiz Başarılı Bir Şekilde Gerçekleştirildi.',
                      'success'
                  );
                      setTimeout(function(){
                      window.location.reload(1);
                      }, 1000);
  
                        }
                    },
                    error: function(xhr, status, error) {
                        // Hata durumunda SweetAlert2 ile bir hata mesajı gösterilebilir
                        Swal.fire({
                            icon: 'error',
                            title: 'Hata!',
                            text: 'Üzgünüz İşleminiz gerçekleştirilemedi.'
                        });
                    }
                    
                });
            }
   });
  });
  </script>
@endsection