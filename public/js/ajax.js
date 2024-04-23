

function readyFn( jQuery ) {  

        var qID = $(this).attr('id');

        if(qID == null){
            qID = 1;
        }

        console.log(qID);

        $.ajax({  
        url:        '/student/ajax',  
        type:       'POST',   
        dataType:   'json', 
        data:       {
            'get_variable': qID
        },

        success: function(data, status) {  
            $("#student a").remove();                        
            for(i = 0; i < data.length; i++) {  
                student = data[i];  
                
                var e = $('<a><div class="d-flex " style="border-bottom: dashed 1px whitesmoke;"><div class="col-2" id = "name"></div><div class="col-10" id = "address"></div></div></a>');
               
                $(e).attr('href', student['id']);
                $('#name', e).html(student['title']);  
                $('#address', e).html(student['article']);  
                $('#student').append(e);  
            }
           
        },  
        error : function(xhr, textStatus, errorThrown) {  
            alert('Ajax request failed.');  
        }  
        });  
     
};

$( document ).ready( readyFn );

$(".loadstudent").on( "click", readyFn );