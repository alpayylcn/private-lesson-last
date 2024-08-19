<!-- Menu -->
 
   
      
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
      <a href="{{route('admin_dashboard.index')}}" class="app-brand-link">
        <img src="{{ asset('Backend\assets\img\logo\destekhocalogo.png') }}" alt="Logo" style="width: 40px; height: 40px; margin-right: 10px;">
        <span class="app-brand-text fs-4 menu-text fw-bolder ms-2 text-capitalize">Destek Hoca</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboard -->
      <li class="menu-item active">
        <a href="{{route('admin_dashboard.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-home-circle"></i>
          <div data-i18n="Analytics">Dashboard</div>
        </a>
      </li>

      
      <!-- Süper Admin -->
      @role('Super-Admin')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">SUPER ADMIN</span>
      </li>
      @endrole
      @role('Teacher')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">ÖĞRETMEN</span>
      </li>
      


      
      @endrole
      @role('Student')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">ÖĞRENCİ PANELİ</span>
      </li>
      @endrole

      <li class="menu-item">
        <a href="{{route('users_profile.index')}}"class="menu-link">
          <i class="menu-icon tf-icons bx bx-user-pin"></i>
          <div data-i18n="Support">Kişisel Bilgiler</div>
        </a>
      </li>

      
      @role('Teacher')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">GELEN DERS TALEPLERİ</span>
      </li>
      <li class="menu-item">
        <a href="{{route('teachers_profile.appointment_from_student')}}"class="menu-link">
          <i class="menu-icon tf-icons bx bx-line-chart"></i>
          <div data-i18n="Support">İlanlardan Gelen Talepler</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('lesson.approve.page')}}"class="menu-link">
          <i class="menu-icon tf-icons bx bx-alarm"></i>
          <div data-i18n="Support">Teklife Açık Talepler</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">İLAN</span>
      </li>
      <li class="menu-item">
        <a href="{{route('advertisement.create')}}"class="menu-link">
          <i class="menu-icon tf-icons bx bx-line-chart"></i>
          <div data-i18n="Support">İlan Ver</div>
        </a>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">CÜZDAN</span>
      </li>
      <li class="menu-item">
        <a href="{{route('advertisement.create')}}"class="menu-link">
          <i class="menu-icon tf-icons bx bx-money"></i>
          <div data-i18n="Support">TL Yükle</div>
        </a>
      </li>
      @endrole
      @role('Student')
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">DERS TALEBİ</span>
      </li>
      <li class="menu-item">
        <a href="{{route('teacher_cards.index')}}"class="menu-link">
          <i class="menu-icon tf-icons bx bx-user-pin"></i>
          <div data-i18n="Support">Öğretmen Ara</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('all_step_filter')}}"class="menu-link">
          <i class="menu-icon tf-icons bx bx-book-open"></i>
          <div data-i18n="Support">Ders Ara</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('lesson_request_list.index')}}"class="menu-link">
          <i class="menu-icon tf-icons bx bx-pin"></i>
          <div data-i18n="Support">Ders Taleplerim</div>
        </a>
      </li>
     
      @endrole
      @role('Super-Admin')
      <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons bx bx-lock-open-alt"></i>
          <div data-i18n="Authentications">Yetkilendirmeler</div>
        </a>
        <ul class="menu-sub">
          
          <li class="menu-item">
            <a href="auth-login-basic.html" class="menu-link" target="_blank">
              <div data-i18n="Basic">Yetkilendirmeler</div>
            </a>
          </li>
          
          
          
        </ul>
      </li>
      
      <!-- Formlar -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Formlar</span></li>
      
      <li class="menu-item">
        <a href="{{route('lessons.addLessonList')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Basic">Ders/Sınıf Ekle</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('admin.filterItems')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Boxicons">Ders Arama Adımları</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('all_step_filter')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail text-warning"></i>
          <div data-i18n="Basic" class="text-warning">Ders Arama Adımları (Önizleme)</div>
        </a>
      </li>
      <!-- Öğretmenler -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Öğretmenler</span></li>
      <li class="menu-item">
        <a href="{{route('admin.teacherList')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-user-check"></i>
          <div data-i18n="Tables">Öğretmen Onayla</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-list-check"></i>
          <div data-i18n="Tables">Öğretmen Profil Onayla</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-message-square-check"></i>
          <div data-i18n="Tables">İlan/Reklam Onayla</div>
        </a>
      </li>



      <!-- Öğrenciler -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Öğrenciler</span></li>
      
      <li class="menu-item">
        <a href="{{route('request_durations.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-detail"></i>
          <div data-i18n="Basic">Öğrenci İlan Süreleri</div>
        </a>
      </li>
     
      <!-- Cüzdan -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Cüzdan</span></li>
      <li class="menu-item">
        <a href="{{route('durations.index')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-money"></i>
          <div data-i18n="Tables">İlan Ücretleri</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="{{route('admin.credit-settings.edit')}}" class="menu-link">
          <i class="menu-icon tf-icons bx bx-money"></i>
          <div data-i18n="Tables">Teklif Ücretleri</div>
        </a>
      </li>
      <li class="menu-item">
        <a href="tables-basic.html" class="menu-link">
          <i class="menu-icon tf-icons bx bx-money"></i>
          <div data-i18n="Tables">Kredi Hediye Et</div>
        </a>
      </li>

        <!-- Raporlama -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Raporlama</span></li>
        <li class="menu-item">
          <a href="{{route('admin.teacherList')}}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user-pin"></i>
            <div data-i18n="Tables">Öğretmen Listesi</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="tables-basic.html" class="menu-link">
            <i class="menu-icon tf-icons bx bx-user-pin"></i>
            <div data-i18n="Tables">Öğrenci Listesi</div>
          </a>
        </li>
      @endrole
      <!-- Destek -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Destek</span></li>
      <li class="menu-item">
        <a href=""target="_blank" class="menu-link">
          <i class="menu-icon tf-icons bx bx-support"></i>
          <div data-i18n="Support">Destek</div>
        </a>
      </li>
      <li class="menu-item">
        <a href=""target="_blank" class="menu-link">
          <i class="menu-icon tf-icons bx bx-file"></i>
          <div data-i18n="Documentation">Dokümanalar</div>
        </a>
      </li>
    </ul>
  </aside>
  <!-- / Menu -->
  