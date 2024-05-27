@extends('master')
@section('title')
<title> Destek Hoca / Ders Lokasyonu </title>
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
      <form method="POST" action="{{route('admin.filterOptionsUpdate')}}" enctype="multipart/form-data">
        @csrf 
        <input type="hidden" name="user_id" value="{{$userId}}">
      <div class="col-md-12">
        {{-- Top Buttons Start --}}
        <ul id="step-questions-nav" class="nav nav-pills flex-column flex-md-row mb-3">
          <li class="nav-item">
            <a class="nav-link border active" href="{{route('admin.filterItems')}}">
            <i class="bx bx-blanket  me-1"></i>Filtre Adımları / Sorular</a>
          </li>
           @forelse ($stepQuestions as $question)
           <li class="nav-item">
            <button type="button" class="nav-link  border step-question-btn" data-id="{{ $question->id }}" >
            <i class="bx bx-blanket  me-1"></i>{{$question->title}}</button>
            
          </li>
           @empty
             <li>KAYITLI SORU BULUNAMADI</li>
           @endforelse
          </ul>
        {{-- Top Buttons End --}}
        @if($errors->any())
                @foreach ($errors->all() as $error)
                  <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
                @endforeach
              @endif
        <div class="row">
          <div class="col-md-8">
            <div class="card mb-4">
              <div class="row">
              <h5 id="questionTitle" class="card-header"></h5>
              
              <div class="card-body mb-3">
              {{-- table --}}
              <div>
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Öğrenci Filtre Ekranı</th>
                         <th>Öğretmenin Gördüğü</th>
                         <th></th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="step-option-titles">
                      
                     
                    </tbody>
                  </table>
                </div>
              </div>


              
               

                <div class="mt-2">
                  <button type="submit" id="submit" class="btn btn-primary me-2">GÜNCELLE</button>   
                  <div id="defaultFormControlHelp" class="form-text">
                    Güncelle butonuna bastığınızda verdiğiniz bilgilerin doğruluğunu onaylamış olursunuz.
                  </div>
                </div>
              </div>
            </form>      
            </div>
            </div>
          </div>
    
          <div class="col-md-4">
            <div class="card mb-4">
              <h5 class="card-header">YENİ BAŞLIK EKLEME </small></h5>
                <div class="card-body mb-3">
                  
                  <div id="defaultFormControlHelp" class="form-text mb-1">
                   Ekle butonuna basarak yeni başlık ekleyebilirsiniz.
                   </div>
                  
                    <input type="hidden" name="user_id" id="user_id" value="{{$userId}}">
                     <table id="classes_table" class="col-12">
                       <tr>
                       <td class="col-12"> <input type="text" id="title" name="title" class="form-control" placeholder="Öğrencinin Göreceği Başlık"></td>
                       
                       </tr> 
                       <tr>
                        <td class="col-12"> <input type="text" id="teacher_title" name="teacher_title" class="form-control" placeholder="Öğretmenin Göreceği Başlık"></td>
                        
                        </tr> 
                        <td id="step-question-id"></td>
                        
                        <tr>
                            
                          <td><button type="button" class="form-control btn-warning btnoptionadd">EKLE</button></td>
                          </tr> 
                       </table>
                       
                      </form>
                </div>
            </div>
          </div>
        
                  </div>
                    <div class="card mb-4">
                      <div class="card-body">
                        
    
                        </div>
                      </div>
                    </div>
        </div>
        </div>
      </div>




{{-- ************************************************************************* --}}
    
@endsection
@section('js')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">

        


        $(document).ready(function(){
            $('.step-question-btn').click(function(){
                var stepQuestionId = $(this).data('id');
                $.ajax({
                    url: '/step-questions/' + stepQuestionId + '/step-option-titles',
                    
                    type: 'GET',
                    success: function(response) {
                        
                            
                         $('#step-option-titles').empty();
                            response.forEach(function(stepOptionTitle) {

                            
                            var newRow = `
                            <tr id="item-${stepOptionTitle.id}">
                                <td class="col-6"><input type="text" name="title[${stepOptionTitle.id}]" class="form-control" value="${stepOptionTitle.title ?? ''}" placeholder=""></td>
                                <td class="col-6"><input type="text" name="teacher_title[${stepOptionTitle.id}]" class="form-control" value="${stepOptionTitle.teacher_title ?? ''} " placeholder=""></td>
                                <td><button id="${stepOptionTitle.id}" type="button" class="btnoptionforcedelete form-control btn-danger"><i class="bx bx-trash  me-2"></button></td>
                                <input type="hidden" name="question_id"value="${stepOptionTitle.question_id}">
                            </tr>
                        `;
                           
                            $('#step-option-titles').append(newRow);
                           
                            $('#step-question-id').empty();
                            $('#step-question-id').append('<input type="hidden" id="question_id" name="question_id"value="'+stepOptionTitle.question_id+'">');
                            
                           
                        });

 
                        $('.btnoptionforcedelete').click(function() {
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
                                            url: "{{route('admin.filterOptionsDelete')}}",
                                            data:{_token:"{{ csrf_token() }}",id:id},
                                            success: function(msg) {
                                            if (msg) {
                                            Swal.fire(
                                            'Silindi!',
                                            'İşleminiz Başarılı Bir Şekilde Gerçekleştirildi.',
                                            'success'
                                        );
                                            
                                                $('#item-'+id).remove();
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
                    }
                });
            });
        });
    </script>

<script>
        $('.btnoptionadd').click(function() {
        const userId = document.getElementById('user_id').value;
        const questionId = document.getElementById('question_id').value;
        const title = document.getElementById('title').value;
        const teacherTitle = document.getElementById('teacher_title').value;

        const data = { 
            user_id: userId, 
            question_id: questionId, 
            title: title,
            teacher_title: teacherTitle 
        };

        fetch("{{ route('admin.filterOptionsAdd') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(stepOptionTitle => {
                // Yeni satırı oluştur
                var newRow = `
                    <tr>
                        <td class="col-6"><input type="text" name="title[${stepOptionTitle.id}]" class="form-control" value="${stepOptionTitle.title ?? ''}" placeholder=""></td>
                        <td class="col-6"><input type="text" name="teacher_title[${stepOptionTitle.id}]" class="form-control" value="${stepOptionTitle.teacher_title ?? ''}" placeholder=""></td>
                        <td><button id="${stepOptionTitle.id}" type="button" class="btnoptionforcedelete form-control btn-danger"><i class="bx bx-trash  me-2"></i></button></td>
                        <input type="hidden" name="question_id" value="${stepOptionTitle.question_id}">
                    </tr>
                `;
                // Yeni satırı tablonun sonuna ekle
                $('#step-option-titles').append(newRow);
               
            })
            .catch((error) => {
                console.error('Error:', error);
            });
    });

    

</script>

{{-- Linkleri aktif yapma --}}
<script>
    $(document).ready(function() {
      $('#step-questions-nav .nav-link').on('click', function() {
        // Tüm linklerden 'active' sınıfını kaldır
        $('#step-questions-nav .nav-link').removeClass('active');
        // Tıklanan linke 'active' sınıfını ekle
        $(this).addClass('active');
      });
    });
  </script>
@endsection
