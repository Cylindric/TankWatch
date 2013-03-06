// on dom ready
$(document).ready(function(){
    // class exists
    if($('.delete_row').length) {
        // add click handler
        $('.delete_row').click(function(){
            // ask for confirmation
            var result = true; //confirm('Are you sure you want to delete this?');
		
            // show loading image
            $('.ajax_loader').show();
            $('#flashMessage').fadeOut();
		
            // get parent row
            var row = $(this).parents('tr');
            row.fadeOut();
		
            // do ajax request
            if(result) {
                $.ajax({
                    type:"POST",
                    url:$(this).attr('href'),
                    data:"ajax=1",
                    dataType: "json",
                    success:function(response){
                        // hide loading image
                        $('.ajax_loader').hide();
					
                        // hide table row on success
                        if(response.type != 'success') {
                            row.fadeIn();
                        }

                        // show respsonse message
                        if(response.msg) {
                            $.pnotify({
                                title: null,
                                text: response.msg,
                                type: response.type,
                                history: false
                            });
                        }
                    }
                });
            }
            return false;
        });
    }
});