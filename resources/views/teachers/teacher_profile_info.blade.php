@extends('master')
@section('title')
<title> Destek Hoca / ... </title>
@endsection

@section('css')
   
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
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ayarlar /</span> Profil Sayfası</h4>
  <div class="row">
    <form method="POST" action="{{route('teachers_profile.updateProfile')}}" enctype="multipart/form-data">
      @csrf 
      <input type="hidden" name="user_id" value="1">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
          <li class="nav-item">
            <a class="nav-link" href="{{route('teachers_profile.index')}}"><i class="bx bx-user me-1"></i> Kişisel Bilgiler</a>
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
            <a class="nav-link  active" href="">
            <i class="bx bx-news  me-1"></i>Profil Bilgileri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('teachers_profile.front')}}"
              ><i class="bx bx-world me-1"></i>Profil Önizleme</a
            >
          </li>
        </ul>
        <div class="card mb-4">
          <h5 class="card-header">Profil Detayları</h5>
        </div>
        
    <div class="row">
    
        <div class="col-md">
          <div  class="card mb-3">
            <div class="row g-0">
              <div class="col-md-5">
                <img class="card-img card-img-left p-1" src="{{asset('backend/assets')}}/img/avatars/teachers_avatar_male.jpg" alt="Card image" />
              </div> 
                <div class="col-md-7">
                  <div class="card-body">
                    <h5 class="card-title">{{$data['teacherData']->name}} {{$data['teacherData']->surname}}</h5> 
                    
                    <p class="card-text">
                      Matematik derslerinizde başarılı olmak mı istiyorsun? 15 Yıllık tecrübe sahibi Yeni nesil sorular konusunda uzman bir öğretmenim. 
                    </p>
                  </div>
                </div>
            </div>
            <hr style="border: 2px solid">
              <div class="row g-0">
                <div class="p-2 col-md-6">
                  <button  disabled class="btn btn-outline-primary">ÖĞRETMENDEN RANDEVU AL</button>
                </div>
                <div class="p-2 col-md-6">
                 <button disabled class="btn btn-outline-danger">ÖĞRETMEN PROFİLİNİ GÖR</button>
                </div>
              </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card mb-4" style="height: 280px">
            <h5 class="card-header">Özet Bilgi Mesajı</h5>
              <div class="card-body mb-3" >
                <small>Sizi en iyi anlatan özet tanıtım cümlenizi yazınız. (150 Karakter)</small>
                  <div class="col-md">
                      <textarea class="form-control" rows="5"  maxlength="150" name="teacher_short_info" value="" id="">{{$data['teacherProfileData']->teacher_short_info}}  </textarea>
                  </div>
                  
              </div>
            </div>
        </div>

        <div class="col-md-4" >
            <div class="card mb-4" style="height: 280px">
              <h5 class="card-header">Mezuniyet Bilgileri</h5>
              <div class="card-body mb-3">
                <div class="mb-3" >
                  <label for="firstName" class="form-label">Üniversite</label>
                  <input class="form-control" type="text"id=""name="teacher_university"value="{{$data['teacherProfileData']->teacher_university}}" autofocus />
                </div>
                <div class="mb-3" >
                  <label for="firstName" class="form-label">Tecrübe (Yıl)</label>
                  <input class="form-control" type="text"id=""name="teacher_experience_year"value="{{$data['teacherProfileData']->teacher_experience_year}}" autofocus />
                </div>
                <div class="mb-3" >
                  <div class="form-check checkbox payment-radio">
                      <input class="form-check-input" name="university_check" type="checkbox" value="1" id="defaultCheck1"/>
                      <label class="form-check-label" for="defaultCheck1">Bu Bilgiler Profilimde Gösterilsin</label>
                  </div>
                </div>
              </div>
            </div>
        </div>
        
  <div class="col-md-6" >
    <div class="card mb-4">
      <h5 class="card-header">Detaylı Tanıtım Bilgisi (Öğretmen Hakkında)</h5>
              <div class="card-body mb-3" >
                <small>Sizi en iyi anlatan daha ayrıntılı...</small>
                  <div class="col-md">
                      <textarea class="form-control" rows="17"  name="teacher_about" value="" id="">{{$data['teacherProfileData']->teacher_about}} </textarea>
                  </div>
             </div>
    </div>
  </div>
  <div class="col-md-6" >
    <div class="mb-4 md-0">
        
        <div class="accordion" id="accordionExample">
          <div class="card accordion-item active">
            <h2 class="accordion-header" id="headingOne">
              <button type="button"class="accordion-button"data-bs-toggle="collapse"data-bs-target="#accordionOne"aria-expanded="true"aria-controls="accordionOne">
                Öğretmenin Sunduğu İmkanlar
              </button>
            </h2>
            <div id="accordionOne"class="accordion-collapse collapse show"data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <textarea class="form-control" rows="5"  name="teacher_facility" value="" id=""> {{$data['teacherProfileData']->teacher_facility}}</textarea>
              </div>
            </div>
          </div>
          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"  data-bs-target="#accordionTwo"aria-expanded="false" aria-controls="accordionTwo" >
                Neden Özel Ders Veriyorum
              </button>
            </h2>
            <div id="accordionTwo" class="accordion-collapse collapse"aria-labelledby="headingTwo" data-bs-parent="#accordionExample" >
              <div class="accordion-body">
                <textarea class="form-control" rows="5"  name="teacher_why_lesson" value="" id=""> {{$data['teacherProfileData']->teacher_facility}}</textarea>
              </div>
            </div>
          </div>
          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionThree"aria-expanded="false"aria-controls="accordionThree">
                Tecrübelerim
              </button>
            </h2>
            <div id="accordionThree"class="accordion-collapse collapse"aria-labelledby="headingThree"data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <textarea class="form-control" rows="5"  name="teacher_experience" value="" id="">{{$data['teacherProfileData']->teacher_facility}} </textarea>
              </div>
            </div>
          </div>
          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFour"aria-expanded="false"aria-controls="accordionFour">
                Size Neler Kazandırabilirim
              </button>
            </h2>
            <div id="accordionFour"class="accordion-collapse collapse"aria-labelledby="headingFour"data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <textarea class="form-control" rows="5"  name="teacher_bring" value="" id=""> {{$data['teacherProfileData']->teacher_bring}}</textarea>
              </div>
            </div>
          </div>
          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingFive">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionFive"aria-expanded="false"aria-controls="accordionFive">
                Hakkımda Bilmeniz Gerekenler
              </button>
            </h2>
            <div id="accordionFive"class="accordion-collapse collapse"aria-labelledby="headingFive"data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <textarea class="form-control" rows="5"  name="teacher_about_me" value="" id=""> {{$data['teacherProfileData']->teacher_about_me}}</textarea>
              </div>
            </div>
          </div>
          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingSix">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionSix"aria-expanded="false"aria-controls="accordionSix">
                Dersleri Nasıl İşlerim
              </button>
            </h2>
            <div id="accordionSix"class="accordion-collapse collapse"aria-labelledby="headingSix"data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <textarea class="form-control" rows="5"  name="teacher_lesson_process" value="" id=""> {{$data['teacherProfileData']->teacher_lesson_process}}</textarea>
              </div>
            </div>
          </div>
          <div class="card accordion-item">
            <h2 class="accordion-header" id="headingSeven">
              <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordionSeven"aria-expanded="false"aria-controls="accordionSeven">
                Ders Alacaklara Tavsiyelerim
              </button>
            </h2>
            <div id="accordionSeven"class="accordion-collapse collapse"aria-labelledby="headingSeven"data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <textarea class="form-control" rows="5"  name="teacher_advices" value="" id=""> {{$data['teacherProfileData']->teacher_advices}}</textarea>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>

  <div class="col-md-6" >
    <div class="card mb-4">
      <h5 class="card-header">Kısa Tanıtım Videosu (Youtube Linki)</h5>
              <div class="card-body mb-3" >
                <small>Kendinizi kısaca tanıtan videonuzun youtube bağlantısını ekleyebilirsiniz.</small>
                  <div class="col-md mt-3">
                    <input class="form-control" type="text" id="firstName"name="teacher_video_link" value="{{$data['teacherProfileData']->teacher_video_link}}" autofocus />
                    <input class="form-check-input mt-3" name="video_check" type="checkbox" value="1" id="defaultCheck1"/>
                    <label class="form-check-label mt-3" for="defaultCheck1">Tanıtım videom yok</label>
                  </div>
             </div>
    </div>
  </div>
    </div>
            
      
    

    
      <div class="card mb-4">
        <div class="card-body">
          <div class="mt-2">
              <button type="submit" id="submit" class="btn btn-primary me-2">GÖNDER</button>   
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