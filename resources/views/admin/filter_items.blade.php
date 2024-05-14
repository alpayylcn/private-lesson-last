@extends('master')
@section('title')
<title> Destek Hoca / Filtreleme Ekranı </title>
@endsection

@section('css')
   css kodlar
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
  <form method="POST" action="" enctype="multipart/form-data">
    @csrf 
    <input type="hidden" name="user_id" value="1">
  <div class="col-md-12">
    {{-- Top Buttons Start --}}
    @include('admin.layout.tabs_filter_items')
    {{-- Top Buttons End --}}
    
    <div class="row">
      <div class="col-md-6">
        <div class="card mb-4">
          <div class="row">
          <h5 class="card-header">Filtreleme Adımları (Sorular)</h5>
          <div class="card-body mb-3">
            
            <table>
              <th>Sorular</th>
              <th>Sıra Numarası</th>
              @foreach ($data as $question)
              <tr> 
                <td class="col-10"><input type="text" name="title[{{$question->id}}]" class="form-control" value="{{$question->title}}" placeholder=""></td>
                <td><input type="text" name="title[{{$question->id}}]" class="form-control" value="{{$question->rank}}" placeholder=""></td>
              </tr>
              @endforeach
              
            </table>
            
           
          </div>
          
        </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">YENİ ADIM EKLEME </small></h5>
            <div class="card-body mb-3">
              
              <div id="defaultFormControlHelp" class="form-text mb-1">
                Adım Ekle butonuna basarak birden fazla ders ekleyebilirsiniz.
               </div>
   
                 <table id="classes_table">
                   <tr>
                   <td class="col-10"> <input type="text" name="lesson1" class="form-control" placeholder=""></td>
                   <td><a href="javascript:void(0);" class="addClass btn btn-primary me-2">Adım Ekle</a></td>
                   </tr>  
                   </table>
            </div>
        </div>
      </div>
    
              </div>
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
  </div>

@endsection

@section('js')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){

	var cnt = 2;
	$(".addLesson").click(function(){
		$("#lessons_table").append('<tr><td><input type="text" name="lesson'+cnt+'" class="form-control" placeholder=""></td><td><a href="javascript:void(0);" class="remLesson btn btn-primary me-2">Sil</a></td></tr>');
		cnt++;
		
	});
	

    $("#lessons_table").on('click','.remLesson',function(){
		if (confirm("Silmek istediğinizden emin misiniz?"))
        {
        $(this).parent().parent().remove();
		}
    });	
  
	
});
	
</script>

<script type="text/javascript">

  $(document).ready(function(){
  
    var cnt = 2;
    $(".addClass").click(function(){
      $("#classes_table").append('<tr><td><input type="text" name="lesson'+cnt+'" class="form-control" placeholder=""></td><td><a href="javascript:void(0);" class="remClass btn btn-primary me-2">Sil</a></td></tr>');
      cnt++;
      
    });
    
  
      $("#classes_table").on('click','.remClass',function(){
      if (confirm("Silmek istediğinizden emin misiniz?"))
          {
          $(this).parent().parent().remove();
      }
      });	
    
    
  });
    
  </script>

@endsection