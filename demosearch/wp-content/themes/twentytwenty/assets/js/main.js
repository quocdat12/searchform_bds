(function($){
    $(document).ready(function(){
        $('#tinh_tp').change(function(event){
            var id = $(this).val();
            var data = $('#' + id).html();
            $('select#xa_huyen').html(data);
        });
        console.log(tinh_tp);
    })
})(jQuery)