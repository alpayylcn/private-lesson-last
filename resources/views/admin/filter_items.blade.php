@extends('master')
@section('title')
<title> Destek Hoca / Filtreleme Ekranı </title>
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
  <form method="POST" action="{{route('admin.filterItemsUpdate')}}">
    @csrf 
    <input type="hidden" name="user_id" value="{{$userId}}">
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
                <td class="col-10"><input type="text" disabled name="title[{{$question->id}}]" class="form-control" value="{{$question->title}}" placeholder=""></td>
                <td><input type="text" name="title[{{$question->id}}]" class="form-control" value="{{$question->rank}}" placeholder=""></td>
              <form method="POST" action="{{route('admin.filterItemsDelete')}}">
                <td><button type="submit" class="form-control btn-danger"><i class="bx bx-trash  me-2"></button></td>
              </form>  
                
              
                </tr>
              
              @endforeach
              
            </table>
            @if($errors->any())
            @foreach ($errors->all() as $error)
              <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
            @endforeach
          @endif 
          @if($errors->has('user_id'))
            @foreach ($errors->get('user_id') as $errorUser)
              <div class="alert alert-danger mt-2">{{ $errorUser }}</div>
            @endforeach
          @endif
            <div class="mt-2">
              <button type="submit" id="submit" class="btn btn-primary me-2">GÜNCELLE</button>   
              <div id="defaultFormControlHelp" class="form-text">
                Güncelle butonuna bastığınızda verdiğiniz bilgilerin doğruluğunu onaylamış olursunuz.
              </div>
            </div>
           
          </div>
          
        </div>
        </div>
      </div>
    </form>
    
      <div class="col-md-6">
        <div class="card mb-4">
          <h5 class="card-header">YENİ ADIM EKLEME </small></h5>
            <div class="card-body mb-3">
              
              <div id="defaultFormControlHelp" class="form-text mb-1">
                Soru eklerken sıra numarasını eklemeyi unutmayınız...
               </div>
               <form method="POST" action="{{route('admin.filterItemsAdd')}}" enctype="multipart/form-data">
                @csrf 
                <input type="hidden" name="user_id" value="{{$userId}}">
                 <table id="classes_table">
                   <tr>
                   <td class="col-8"> <input type="text" name="title" class="form-control" placeholder="Soru"></td>
                   <td class="col-2"> <input type="text" name="rank" class="form-control" placeholder="Sıra Numarası"></td>
                   <td><button type="submit" class="addClass btn btn-warning me-2">EKLE</button></td>
                   </tr>  
                   </table>
                    @if($errors->has('title'))
                        @foreach ($errors->get('title') as $error)
                          <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
                        @endforeach
                    @endif 
                    @if($errors->has('rank'))
                        @foreach ($errors->get('rank') as $error)
                          <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
                        @endforeach
                    @endif 
                    @if($errors->has('user_id'))
                        @foreach ($errors->get('user_id') as $errorUser)
                          <div class="alert alert-danger mt-2">{{ $errorUser }}</div>
                        @endforeach
                    @endif
                  </form>
            </div>
        </div>
      </div>
    
              </div>
                <div class="card mb-4">
                  <div class="card-body">
                    
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