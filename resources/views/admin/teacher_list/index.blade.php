@extends('master')
@section('title')
<title> Destek Hoca / Ders Ekle Sil </title> 
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-switch/3.3.4/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet">

@endsection




@section('content')
   
<!-- Content wrapper -->
<div class="content-wrapper">
<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
{{-- Top Buttons Start --}}
<div class="d-flex flex-wrap" id="icons-container">
  <a href="{{route('admin.teacherList')}}">
    <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
      <div class="card-body">
        <i class="bx bx-user-check mb-2 text-primary"></i>
        <p class="icon-name text-capitalize text-truncate mb-0">Öğretmen Onay</p>
      </div> 
    </div>
  </a>
  <a href="{{route('admin.studentList')}}">
    <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
      <div class="card-body">
        <i class="bx bx-user-check mb-2 text-primary"></i>
        <p class="icon-name text-capitalize text-truncate mb-0">Öğrenci Onay</p>
      </div>
    </div>
</div>
</a>
{{-- Top Buttons End --}}

<div class="row">
  
  <div class="col-md-12">
    
    
        <div class="card mb-4">
          <h5 class="card-header">KAYITLI ÖĞRETMENLER <small>(Toplam <b class="text-primary fs-4"> {{ $totalTeachers }} </b>kayıtlı öğretmenden <b class="text-danger fs-4">{{ $unapprovedTeachers }}</b> onay bekleyen)</small></h5>
          {{-- Öğretmen Arama --}}
          <div class="row card-body mb-3">
            <form method="GET" action="">
              <div class="row mb-3">
                  <div class="col-md-6">
                      <input type="text" name="search" class="form-control" placeholder="Ara... İsim yada Email adresi yazın" value="{{ request()->query('search') }}">
                  </div>
                  <div class="col-md-2">
                      <button type="submit" class="btn btn-primary"> <i class="bx bx-search fs-4 lh-0"></i></button>
                  </div>
              </div>
          </form>

          
               
            <div class="col-lg-12 mb-4 mb-xl-0">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="col-2">Adı Soyadı</th>
                        <th scope="col" class="col-3">Mail Adresi</th>
                        <th scope="col" class="col-2">Onay Durumu</th>
                        <th scope="col" class="col-2">Detay</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                      
                      @forelse ($teachers as $teacher)
                         <tr id="teacher-{{ $teacher->id }}">
                          <td class="p-1"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$teacher->name}} {{$teacher->surname}}</strong></td>
                          <td >{{$teacher->email}}</td>

                          
                          <td class="approved-status">
                            <input type="checkbox" class="approve-switch" data-id="{{ $teacher->id }}" {{ $teacher->approved ? 'checked' : '' }}>
                         </td>
                          
                          <td class="p-2">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#teacherModal{{ $teacher->id }}">Göster</button>
                          </td> 
                          
                         
                        </tr>

                   
                <!-- Modal -->
                <div class="modal fade" id="teacherModal{{ $teacher->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Öğretmen Bilgileri</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <hr class="mx-4">
                          <div class="modal-body">
                              <div class="row">
                                  <div class="col-md-4">
                                      <!-- Profil resmi -->
                                      <img src="{{asset('backend/assets')}}/img/profileimages/{{ $teacher->profile_image ?: '/no_image.jpg' }}" class="rounded img-fluid" alt="Profile Picture">
                                  </div>
                                  
                                  <div class="col-md-8 mt-3">
                                      <!-- Öğretmen bilgileri -->
                                      
                                      <p><strong>Adı Soyadı:</strong> {{ $teacher->name }} {{ $teacher->surname }}</p>
                                      <p><strong>Email Adresi:</strong> {{ $teacher->email }}</p>
                                      <p><strong>Telefon:</strong> {{ $teacher->userDetails ? $teacher->userDetails->phone : '' }}</p>
                                      <p><strong>Şehir:</strong> {{ $teacher->userDetails ? $teacher->userDetails->cityName->city : '' }} / {{ $teacher->userDetails ? $teacher->userDetails->countyName->county : '' }}</p>
                                      
                                      
                                      
                                  </div>
                              </div>
                          </div>
                          <hr class="mx-4">
                          <div class="modal-footer">
                              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">KAPAT</button>
                          </div>
                      </div>
                  </div>
              </div><!-- End Modal -->
                      @empty
                        <tr>
                          <td>Kayıtlı Öğretmen Bulunamadı...</td>
                        </tr>
                      @endforelse
                      
                    </tbody>
                  </table>
                  <hr>
                  {{ $teachers->links() }}

                  
                </div>

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
  
      $('.approve-switch').on('switchChange.bootstrapSwitch', function (event, state) {
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