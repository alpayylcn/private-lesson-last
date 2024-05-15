<div class="mb-3 col-md-4">
  <label class="text-label form-label" for="validationCustomUsername">İl</label>
    <select id="city-dd" name="city" class="select2 form-select" required>
      
      @if (!empty ($cityData))
      <option value="{{ $userDetailData->city }}">{{ $userDetailData->cityName->city }}</option>
      @endif
      <option value="">Şehir Seçiniz</option>
      @foreach ($allCity as $city)
      <option value="{{ $city->id }}">{{ $city->city }}</option>
      @endforeach
      
      
    </select>
    @if($errors->has('city'))
    @foreach ($errors->get('city') as $error)
      <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
    @endforeach
  @endif 
</div>

<div class="mb-3 col-md-4">
  <label class="text-label form-label" for="validationCustomUsername">İlçe</label>
    <select id="county-dd" name="county" class="select2 form-select"  required>
      @if (!empty ($userDetailData->county) && !empty($userDetailData->countyName))
      <option value="{{ $userDetailData->county }}">{{ $userDetailData->countyName->county }}</option>
      @endif
    </select>
    @if($errors->has('county'))
    @foreach ($errors->get('county') as $error)
      <div class="alert alert-danger col-lg-12 mt-2">{{ $error }}</div>
    @endforeach
  @endif 
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript"> // il ilçe js kodları
  $(document).ready(function() {
  $('#city-dd').change(function(event) {
      var idCountry = this.value;
     // alert(idCountry); 
       $('#county-dd').html('');

       $.ajax({
       url: "{{route('fetch.county')}}",
       type: 'POST',
       dataType: 'json',
       data: {country_id: idCountry,_token:"{{ csrf_token() }}"},
       success:function(response){
           $('#county-dd').html('<option value="">İlçe Seçiniz</option>');
           $.each(response.counties,function(index, val){
           $('#county-dd').append('<option value="'+val.id+'"> '+val.county+' </option>')
           });
          
       }
       })
  });
  });
</script>

