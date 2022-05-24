(function($) {
    $(document).ready(function() { 
      $( "select[name='tinh_tp']" ).change(function() {
        console.log($(this).find(':selected').attr('data-idp')) ; // lấy data idp
  
        data = {
          'action': 'ajax_danhmuc', //tên action ajax
          'id' :$(this).find(':selected').attr('data-idp')
        };
        $.ajax({
           url: WPURLS.siteurl, 
           data: data,
           dataType : "json",
           type: 'POST', 
           beforeSend: function(xhr) {  
            console.log('ajax chay');            
         },
         success: function(data) {
          if (data) {
            console.log(data);
            $('select[name="xa_huyen"]').html(data.data);//in dữ liệu vào select này
          }
         }
     });
      });
  
    })
  })(jQuery);