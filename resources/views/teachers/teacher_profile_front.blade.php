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
<div class="content-wrapper">
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Ayarlar /</span> Profil Sayfası</h4>
  <div class="row">
    <form method="POST" action="{{route('teachers_profile.update')}}" enctype="multipart/form-data">
      @csrf 
      <input type="hidden" name="user_id" value="1">
    <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-3">
          <li class="nav-item">
            <a class="nav-link" href="{{route('users_profile.index')}}"><i class="bx bx-user me-1"></i> Kişisel Bilgiler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('teachers_profile.lessons')}}"
              ><i class="bx bx-blanket me-1"></i>Ders Sınıf Seçimi</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('teachers_profile.lessonPrice')}}"
              ><i class="bx bx-money  me-1"></i>Ders Süre/Ücret Bilgisi</a
            >
          </li>
          <li class="nav-item">
            <a class="nav-link " href="{{route('teachers_profile.info')}}">
            <i class="bx bx-news  me-1"></i>Profil Bilgileri</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  active" href=""
              ><i class="bx bx-world me-1"></i> Profil Önizleme</a
            >
          </li>
        </ul>
        <div class="card mb-4">
          <h5 class="card-header">Profil Önizleme</h5>
        </div>
    <div class="row">
    
        <div class="col-md-8">
          <div  class="card mb-3">
            <div class="row g-0">
              <div class="col-md-3">
                <img class="card-img card-img p-1" src="{{asset('backend/assets')}}/img/profileimages/{{ Auth::user()->userDetails->profile_image ?: '/no_image.jpg' }}" alt="Card image" />
                <div class="col-md-12 mb-3 d-flex justify-content-center">
                  <button  disabled class="btn btn-outline-secondary m-2 p btn-sm">YÜZYÜZE</button>
                  <button  disabled class="btn btn-outline-secondary m-2 p btn-sm">ONLINE</button>
                </div>
              </div> 
                <div class="col-md-7">
                  <div class="card-body">
                    <h5 class="card-title">{{Auth::user()->name}} {{Auth::user()->surname}} </h5> 
                    <p class="card-text">
                      Matematik derslerinizde başarılı olmak mı istiyorsun? 15 Yıllık tecrübe sahibi Yeni nesil sorular konusunda uzman bir öğretmenim. 
                    </p>
                    <p><i class="bx bx-map me-1"></i><b>{{$data['teacherData']?->city}} / {{$data['teacherData']?->county}}</b></p>
                    <p class="text-success"><i class="bx bx-award me-1"></i><b>10 Yıllık Tecrübe</b></p>
                    <p class="text-primary"><i class="bx bx-arch me-1"></i><b>Marmara Üniversitesi / Fen Edebiyat Fakültesi</b></p>
                  </div>
                </div>
            </div>

          </div>
          <div class="col-md-12">
            <div  class="card mb-3">
              <div class="row g-0">
                <div class="col-md-1 m-3">
                  <img class="card-img card-img p-1" src="{{asset('backend/assets')}}/img/avatars/teachers_avatar_female.jpg" alt="Card image" />
                </div> 
                  <div class="col-md-10">
                    <div class="card-body">
                      <h5 class="card-title">Ayşe Yücel</h5> 
                      <small class="text-danger">Öğretmene Gelen Son Yorum</small>
                      <p class="card-text">
                        Şunu söylemek istiyorum ki bu hoca bir efsanee Sıfır net yapıyordum ve şuan 30 net civari yapıyorum gören duyan herkese tavsiye ederim
                      </p>
                      <p class="card-text text-end ">
                        <a class="text-danger" href="">Tüm Yorumları Gör</a>
                      </p>
                    </div>
                    
                  </div>
              </div>
              
            </div>
          </div>
        </div>

        <div class="col-md-4 " style="position: sticky; top:0%">
          <div class="col-md-12 col-lg-12 mb-3">
            <div class="card h-100">
              <div class="card-body">
                

                <div  class="rounded bg-dark text-center mb-4  embed-responsive embed-responsive-16by9">
                  <iframe class=" rounded embed-responsive-item" src="https://www.youtube.com/embed/tgbNymZ7vqY"></iframe>
                </div>
                <div class="row mb-2"> 
                  <div class="col-md-6 text-center mb-2">
                    <h5 class="card-subtitle text-muted">5.0 <i class="text-warning bx bx-star me-1"></i></h5><small>25 Değerlendirme</small> </div>
                  <div class="col-md-6 text-center">
                    <h5 class="card-subtitle text-muted">500 TL </h5><small>60 Dakika Ders</small> </div>
                
               </div>
                
                
                
               <div class="d-grid gap-2">
                <button class="btn btn-primary mb-3" type="button">DERS TALEBİNDE BULUN</button>
                <p class="text-dark"><i class="bx bx-book-reader me-1"></i><b>120 Öğrenci İle İletişimde</b></p>
                <p class="text-dark"><i class="bx bx-user-check me-1"></i><b>Süper popüler:</b>  Son 48 saat içinde 491 kişi ders almak için başvuru yaptı.</p>
              </div>
                
              </div>
            </div>
          </div>

        </div>
        
        <div class="col-md-8" >
            <div class="card mb-1">
              <h5 class="card-header">Öğretmen Hakkında</h5>
              <div class="card-body mb-3">
                <p>Merhaba ben Metehan , ODTÜ Fizik bölümü mezunuyum. Ortaokul ve Lise öğrencilerine MATEMATIK , FİZİK , GEOMETRİ alanlarında özel dersler veriyorum . KPSS "Genel Yetenek" kısmında da yardımcı olabilirim . Özel ders konusunda tecrubeliyim , 10 yıldır özel ders vermekteyim 47 öğrenciyle çalıştım içlerinde başarılı olanlar fazla sayıdadır . Ankara Yenimahalle'de ikamet etmekteyim , ailemle yaşıyorum . Kendi evime öğrenci kabul etmiyorum ama yer sıkıntısı olursa orta yol bulabiliriz .Genellikle öğrencilerin evine gitmekteyim .
                  Talep ettiğim ücret hakettiğim bir ücrettir ve disiplinli bir şekilde dersimi işlerim dersin süresini ASLA kısaltmam bana güvenebilirsiniz . Ayrıca ÖDEV konusu benim için önemlidir . Ödev yapılmadığı için birçok ogrencimle ters düşme pahasına ailelerine söyledim ve böyle de devam edeceğim . Başarının , disiplinli çalışmadan geldiğini biliyorum . Süre odaklı değilim öğrencinin öğrenmesi ve öğrendikçe mutlu olması ve derse devam etmesi önceliğimdir . Geçmiş yıllarda çalıştığım öğrencilerimin aileleriyle görüşebilir ve hakkımda bilgi alabilirsiniz .
                  Üniversite derslerinde FİZİK2 gibi derslerde yardımcı OLMUYORUM ve hiçbir sınava GİRMİYORUM .
                  İyi günler dilerim .</p>
              </div>
            </div>
        </div>
        

      <div class="col-md-8 mb-4 md-0">
        
        <div class="accordion mt-3" id="accordionExample">
          <div class="card accordion-item active">
            <h2 class="accordion-header" id="headingOne">
              <button type="button"class="accordion-button"data-bs-toggle="collapse"data-bs-target="#accordionOne"aria-expanded="true"aria-controls="accordionOne">
                Öğretmenin Sunduğu İmkanlar
              </button>
            </h2>
            <div id="accordionOne"class="accordion-collapse collapse show"data-bs-parent="#accordionExample">
              <div class="accordion-body">
                Sürekli olan derslerde öğrencinin seviyesine uygun bir kaynak kitap belirlenecek ve kaynak kitap, tarafımdan temin edilecektir.Grup derslerinde ders ücreti konusunda kişi sayısına bağlı olarak indirim yapılacaktır. 
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
                Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake
                dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies.
                Jelly beans candy canes carrot cake. Fruitcake chocolate chupa chups.
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
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
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
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
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
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
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
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
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
                Oat cake toffee chocolate bar jujubes. Marshmallow brownie lemon drops cheesecake. Bonbon
                gingerbread marshmallow sweet jelly beans muffin. Sweet roll bear claw candy canes oat cake
                dragée caramels. Ice cream wafer danish cookie caramels muffin.
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-8" >
        <div class="card mb-2">
          <h5 class="card-header">Öğretmenin Verdiği Dersler</h5>
          <div class="card-body mb-3">
            <div class="row justify-content-center">
              @foreach ($data['teacherToLessonPrice'] as $price )
              @if(!empty($price->visible==1) && !empty($price->lesson->title))
              <div class="col-md-5 rounded m-2 border" style="background-color: rgb(216, 216, 216)">
                <p class="m-2 text-dark"><b>{{$price->lesson->title}}</b> {{$price->lesson_minute}} dk - {{$price->lesson_face_price}} TL | Online Ücret: {{$price->lesson_online_price}} TL</p>
              </div>
              @endif
              @endforeach
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