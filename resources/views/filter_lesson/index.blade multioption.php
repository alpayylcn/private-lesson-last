@extends('master')
@section('title')
<title> Destek Hoca / ... </title>
@endsection

@section('css')
   <!-- Icons. Uncomment required icon fonts -->
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/fonts/boxicons.css" />

   <!-- Core CSS -->
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/css/core.css" class="template-customizer-core-css" />
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
   <link rel="stylesheet" href="{{asset('backend/assets')}}/css/demo.css" />

   <!-- Vendors CSS -->
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

   <!-- Page CSS -->
   <!-- Page -->
   <link rel="stylesheet" href="{{asset('backend/assets')}}/vendor/css/pages/page-auth.css" />
   <!-- Helpers -->
   <script src="{{asset('backend/assets')}}/vendor/js/helpers.js"></script>

   <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
   <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
   <script src="{{asset('backend/assets')}}/js/config.js"></script>
@endsection

@section('js')
   
@endsection
@section('content')
  <div class="container-xxl">
   <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
              @if (!empty ($createId) )
              <form action="{{route('all_step_filter.stepUpdate')}}" method="POST"> 
              @else
              <form action="{{route('all_step_filter.stepCreate')}}" method="POST"> 
              @endif
              
                  @csrf  
                 
                      <div class="card border-success" >
                        <div class="text-center mt-4"><h5 style="text-transform:uppercase">Özel Ders Ara</h5></div>
                        <div class="progress mb-3">
                          <div
                            class="progress-bar progress-bar-striped progress-bar-animated bg-info"
                            role="progressbar"
                            style="width: 12%"
                            aria-valuenow="20"
                            aria-valuemin="0"
                            aria-valuemax="100"
                          >12%</div>
                        </div>
                        @if(!empty ($stepNumber))
                        <input type="hidden" name="question_id" value="{{$stepNumber->id}}">
                        <input type="hidden" name="question_rank" value="{{$stepNumber->rank}}">
                            @if(!empty ($createId))
                            <input type="hidden" name="create_id" value="{{$createId}}">
                            @endif
                          <div class="text-center"><h4 style="text-transform:capitalize">{{$stepNumber->title}}</h4></div>
                          <div class="checkboxcontrol1 btn-group-vertical m-4" role="group" aria-label="Basic radio toggle button group" required>
                            @if($stepOption)
                              @foreach ($stepOption as $option) 
                                  @if (!empty($option->classes))
                                
                                  <input type="radio" class="btn-check" value="{{$option->classes->id}}" name="option_value" id="btnradio{{$option->classes->id}}" required>
                                  <label class="btn btn-outline-info mt-2" for="btnradio{{$option->classes->id}}">{{$option->classes->title}} </label>
                                 
                                  @elseif(!empty ($option->multiOption($option->model_type, $option->option_id)))
                                 
                                  <input type="radio" class="btn-check" value="{{$option->option_id}}" name="option_value" id="btnradio{{$option->option_id}}" required>
                                  <label class="btn btn-outline-info mt-2" for="btnradio{{$option->option_id}}">{{$option->multiOption($option->model_type, $option->option_id)->title}} </label>
                                  @endif
                              @endforeach
                            @endif
                          </div>
                        @endif        
                 <div class="card-footer bg-transparent border-success shadow"><div class="d-grid gap-2 col-lg-12 mx-auto">
                  <button type="submit" class="btn btn-info btn-lg" type="button"><b>DEVAM ET</b></button>
               </div></div>
             </form> 
          </div>
     </div>
    </div>
 @endsection

  

 