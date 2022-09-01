
$(function() {
    $('[data-prevent]').click(function(e) {
        var that = this;

        sweetAlert({
            title: "هل أنت متأكد؟",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "نعم",
            cancelButtonText: "لا",
            closeOnConfirm: false,
            closeOnCancel: true
        }, function(isConfirmed){
            if (isConfirmed)
                $(that).unbind('click').click();
        });

        e.preventDefault();
    })
});