"use strict";

// Class Definition
var FormCustom = function() {

    var handleSubmitt = function(form) {
        $('#response').html('');
        var button = $('#btn_save');
        var button_text = button.text();
        button.prop( "disabled", true );
        button.addClass('disabled');
        button.text('Sedang Memproses...');
        $.ajax({
            type: $(form).attr('method'),
            url: $(form).attr('action'),
            data: $(form).serialize(),
            success: function(data) {
                try {
                    var res = $.parseJSON(data);
                    $('#response').fadeIn('slow').html(res.response);
                    swal.fire({
                        position: "top-right",
                        type: res.status,
                        title: res.message,
                        showConfirmButton: !1,
                        timer: 1500
                    });
                } catch(err)
                {
                    $('#response').fadeIn('slow').html(data);
                }
                button.prop( "disabled", false );
                button.removeClass('disabled');
                button.text(button_text);  
                FormCustom.init();
            }
        })
    }

    var handleSubmitFormShow = function() {
        $("#form_show").validate({
            rules: {
                beritaUnit: {
                    required: true
                }
            },
            submitHandler: function(e) {
                handleSubmitt(e);
                return false
            }
        });
    }

    var handleSubmitForm = function() {
        $("#form_upload").validate({
           rules: {
            beritaJudul: {
                    required: true
                },
            beritaSection: {
                    required: true
                },
                beritaContent: {
                    required: true
                },
                 beritaDatetime: {
                    required: true
                },
                beritaTag: {
                    required: true
                }

       },
       messages : {
                beritaJudul: {
                    required: 'Judul Harus Diisi'
                },
                beritaSection: {
                    required: 'Section Harus Diisi'
                },
                beritaContent: {
                    required: 'Berita Harus Diisi'
                },
                beritaDatetime: {
                    required: 'Judul Harus Diisi'
                },
                beritaTag: {
                    required: 'Berita Harus Diisi'
                }
            },
       submitHandler: function(form) {
           var forms = $("#form_upload")[0];
           var form_data = new FormData(forms);


           $('#response').html('');
           var button = $('#btn_save');
           var button_text = button.text();
           button.prop( "disabled", true );
           button.addClass('disabled');
           button.text('Sedang Memproses...');
           $.ajax({
             type: $("#form_upload").attr('method'),
             url: $("#form_upload").attr('action'),
             processData:false,
             contentType:false,
             cache:false,
             async:false,
             data: form_data,


             success: function(data) {
                try {
                    var res = $.parseJSON(data);
                    $('#response').fadeIn('slow').html(res.response);

                    swal.fire({
                        position: "top-right",
                        type: res.status,
                        title: res.message,
                        showConfirmButton: !1,
                        timer: 1500
                    });

                } catch(err)
                {
                    $('#response').fadeIn('slow').html(data);

                }

                if(res.status=='success')
                        {
                            
                            setTimeout(function(){
                                window.location.href = '/b_berita';
                            }, 2e3);
                                     
                        }
                button.prop( "disabled", false );
                button.removeClass('disabled');
                button.text(button_text);  
                FormCustom.init();
            }
        });
           return false
       }
   });
    }

     var handleClickDelete = function() {
        $(".ts_remove_row").click(function(e) {
            e.preventDefault();
            var idLink = '#'+$(this).attr('id');
            
            swal.fire({
                title: "Apakah Anda Yakin Akan Hapus Data?",
                text: "Data Tidak Dapat Dikembalikan!!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, Hapus!"
            }).then(function(e) {
                e.value && 
                $.ajax(
                {
                    url:$(idLink).attr('href'),
                    success:function(data) 
                    {
                        var res = $.parseJSON(data);
                        $('#response').fadeIn('slow').html(res.response);
                        swal.fire({title: "Deleted!", text: res.message, type: res.status}).then(
                            function(){ 
                                location.reload();
                            }
                            ) ;                   
                    }
                });
            })    
        });
    }

    return {
        // public functions
        init: function() {
            handleSubmitFormShow();
            handleSubmitForm();
            handleClickDelete();
        }
    };
}();

jQuery(document).ready(function() {
    FormCustom.init()
});