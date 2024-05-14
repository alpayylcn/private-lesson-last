@extends('master')
@section('title')
<title> Destek Hoca / ... </title>
@endsection

@section('css')
   css kodlar
@endsection

@section('js')
<script type="text/javascript">
   $(document).ready(function() {
       $('#photo').change(function(e) {
           var reader = new FileReader();
           reader.onload = function(e) {
               $('#ProfilePhoto').attr('src', e.target.result);
           }
           reader.readAsDataURL(e.target.files['0']);
       });
   });
</script>
@endsection


@section('content')
   
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ayarlar /</span> Profil Sayfası</h4>

              <div class="row">
                <form method="POST" action="{{route('teachers_profile.update')}}" enctype="multipart/form-data">
                  @csrf 
                  <input type="hidden" name="user_id" value="1">
                <div class="col-md-12">
                  <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                      <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Kişisel Bilgiler</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('teachers_profile.lessons')}}"
                        ><i class="bx bx-blanket  me-1"></i>Ders Sınıf Seçimi</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('teachers_profile.lessonPrice')}}"
                        ><i class="bx bx-money  me-1"></i>Ders Süre/Ücret Bilgisi</a
                      >
                    </li>
                     <li class="nav-item">
                      <a class="nav-link" href="{{route('teachers_profile.info')}}"
                        ><i class="bx bx-news  me-1"></i>Profil Bilgileri</a
                      >
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{route('teachers_profile.front')}}"
                        ><i class="bx bx-world me-1"></i> Profil Önizleme</a
                      >
                    </li>
                  </ul>
                  <div class="card mb-4">
                    <h5 class="card-header">Kişisel Bilgiler</h5>
                    <!-- Account -->
                    <div class="card-body">
                      <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img id="ProfilePhoto" src="{{asset('backend/assets')}}/img/avatars/teachers_avatar_male.jpg" class="d-block rounded"height="100"width="100"id="uploadedAvatar" />
                        <div class="button-wrapper">
                          <label for="photo" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Fotoğrafı Değiştir</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input type="file" id="photo" class="account-file-input" hidden accept="image/png, image/jpeg" name="photo" value="image"/>
                          </label>
                          <p class="text-muted mb-0">JPG, PNG</p>
                        </div>
                      </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      {{-- <form id="formAccountSettings" method="POST" action="{{route('teachers_profile.update')}}" onsubmit="return false">
                        @csrf --}}
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <input  type="hidden" name="user_id" id="user_id" value="1" readonly />
                            <label for="firstName" class="form-label">Adınız</label>
                            <input class="form-control" type="text"id="firstName"name="firstName"value="{{$data['teacherData']->name}}" autofocus />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="lastName" class="form-label">Soyadınız</label>
                            <input class="form-control" type="text" name="lastName" id="lastName" value="{{$data['teacherData']->surname}}" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail Adresiniz</label>
                            <input class="form-control"type="text"id="email" name="email"value="{{$data['teacherData']->mail}}"/>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label class="form-label" for="phoneNumber">Telefon Numaranız</label>
                            <div class="input-group input-group-merge">
                            <input type="text" id="phone" name="phone" class="form-control" placeholder="+90" value="{{$data['teacherData']->phone}}" required maxlength="11" />
                            </div>
                          </div>
                          
                          @include('teachers.citycounty')
                          
                          <div class="mb-3 col-md-4">
                            <label for="district" class="form-label">Mahalle</label>
                            <input type="text"class="form-control"id="district"name="district"placeholder="{{$data['teacherData']->district}}"/>
                          </div>
                          
                          <div class="card-body">
                            <div class="row gy-3">
                              
                              <div class="col-md">
                                <small class="form-label fw-semibold d-block">Cinsiyet seçiniz</small>
                                <div class="form-check form-check-inline mt-3">
                                  <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="kadın" required />
                                  <label class="form-check-label" for="inlineRadio1">KADIN</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input"type="radio" name="gender" id="inlineRadio2" value="erkek"/>
                                  <label class="form-check-label" for="inlineRadio2">ERKEK</label>
                                </div>
                                
                              </div>
                            </div>
                          </div>
                          
                          
                        </div>
                        
                    </div>
                    <!-- /Account -->
                  </div>
               {{-- <div class="row">
                  <div class="col-md-4">
                    <div class="card mb-4">
                      <h5 class="card-header">Branş Seçenekleri</h5>

                     

                      

                      <div class="card-body mb-3"style="overflow-y: auto; height:150px;">
                        <label for="exampleFormControlSelect2" class="form-label">Yeni ders Ekleyiniz</label>
                        <div class="mb-3" >

                         
                         @foreach ($data['lessons'] as $lesson)
                     
                           <div class="form-check checkbox payment-radio">
                              <input class="form-check-input" name="lesson_id[{{$lesson->id}}]" type="checkbox" value="{{$lesson->id}}"  id="defaultCheck1"/>
                              <label class="form-check-label" for="defaultCheck1"> {{$lesson->title}} </label>
                           </div>
                         @endforeach
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="card mb-4">
                      <h5 class="card-header">Sınıf/Kurs Seçenekleri</h5>

                      


                         <div class="card-body mb-3" style="overflow-y: auto; height:150px;">
                           
                           <label for="exampleFormControlSelect2" class="form-label">Lütfen Sınıf/Kurs Türlerinden Seçiniz</label>
                              <div class="col-md">
                            @foreach ($data['classes'] as $class)
                              <div class="form-check checkbox payment-radio">
                                 <input class="form-check-input" name="class_id[{{$class->id}}]" type="checkbox" value="{{$class->id}}" id="defaultCheck1"/>
                                 <label class="form-check-label" for="defaultCheck1"> {{$class->title}}</label>
                              </div>
                           @endforeach
                              </div>
                           
                        </div>
                     </div>
                  </div>

                  <div class="col-md-4">
                     <div class="card mb-4">
                       <h5 class="card-header">Dersi nerede vermek istersiniz?</h5>
                       <div class="card-body mb-3"style="overflow-y: auto; height:150px;">
                           <div class="mb-3" >
                              <div class="input check_boxes required checkboxcontrol2">
                                @foreach ($data['locations'] as $location)

                                 <div class="form-check form-check-inline mt-3 checkbox payment-radio">
                                    <input class="form-check-input a" name="location_id[{{$location->id}}]" type="checkbox" id="{{$location->id}}" value="{{$location->id}}" />
                                    <label class="form-check-label" for="{{$location->id}}">{{$location->teacher_title}}</label>
                                 </div><br>
                                 @endforeach
                              </div>
                           </div>
                       </div>
                     </div>
                  </div>
               </div> --}}

                  <div class="card mb-4">
                    <div class="card-body">
                    <div class="mt-2">
                      <button type="submit" id="submit" class="btn btn-primary me-2">KAYDET</button>   
                      <div id="defaultFormControlHelp" class="form-text">
                        Gönder butonuna bastığınızda verdiğiniz bilgilerin doğruluğunu onaylamış olursunuz.
                      </div>
                    </div>
                  </form>
                    </div>
                  </div>
                </div>

                
              </div>
            </div>
@endsection