$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var SweetAlert_custom = {
    init: function() {
        document.querySelector('.delete-item').onclick = function(e){ 
            e.preventDefault();
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var href = $(this).attr("href");
                        $.ajax({
                            url: href, data: {_method: "DELETE"}, type: "DELETE", success: function (result) {
                                if (result.status === 'success') {
                                    swal("Data has been deleted!", {
                                        icon: "success",
                                    });
                                } else {
                                    swal("Error!", {
                                        icon: "error",
                                    });
                                }
                            }
                        });
                        location.reload();
                    } else {
                        swal("Data is not deleted!");
                    }
                })
        }; 
    }
};
(function($) {
    SweetAlert_custom.init()
})(jQuery);