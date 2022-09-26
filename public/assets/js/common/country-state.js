$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {
 
    $('#country-dropdown').on('change', function() {
            var country_id = this.value;
             $("#state-dropdown").html('');
            $.ajax({
                url:"{{ route('get-states') }}",
                type: "POST",
                data: {
                    country_id: country_id,
                },
                dataType : 'json',
                success: function(result){
                    $('#state-dropdown').html('<option value="">Select State</option>'); 
                    $.each(result.states,function(key,value){
                    $("#state-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
                    });
                }
            });
         
         
    });  
});