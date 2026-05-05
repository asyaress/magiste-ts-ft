const KTBerita = function () {
    const formSimpan = $('#form_upload');
    const formShow = $('#form_show');
    const btnSave = $('#btn_save');
    const btnShow = $('#btn_show');
    const btnSaveText = btnSave.text();
    const btnShowText = btnShow.text();

    const showSubmit = (form) => {
        $('#response').html('');
        btnSave.prop("disabled", true);
        btnSave.addClass('disabled');
        btnSave.text('Sedang Memproses...');
        const dataSave = new FormData($(form)[0]);
        $.ajax({
            type: $(form).attr('method'),
            url: $(form).attr('action'),
            data: dataSave,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
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
                } catch (err) {
                    $('#response').fadeIn('slow').html(data);
                }
                btnSave.prop("disabled", false);
                btnSave.removeClass('disabled');
                btnSave.text(btnSaveText);
            }
        });
    }

   
     const handleClickDelete = () => {
        $(".ts_remove_row").click(e => {
            e.preventDefault();
            var idLink = '#' + $(e.currentTarget).attr('id');
            swal.fire({
                title: "Apakah Anda Yakin Akan Hapus Data?",
                text: "Data Tidak Dapat Dikembalikan!!",
                type: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, Hapus!"
            }).then(function (e) {
                e.value &&
                    $.ajax(
                        {
                            url: $(idLink).attr('href'),
                            success: function (data) {
                                var res = $.parseJSON(data);
                                $('#response').fadeIn('slow').html(res.response);
                                swal.fire({ title: "Deleted!", text: res.message, type: res.status }).then(
                                    function () {
                                        location.reload();
                                    }
                                );
                            }
                        });
            })
        });
    }

      const handleSubmit =(form) => {
        $('#response').html('');
         btnShow.prop("disabled", true);
        btnShow.addClass('disabled');
        btnShow.text('Sedang Memproses...');
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
                btnShow.prop( "disabled", false );
                btnShow.removeClass('disabled');
                btnShow.text(btnShowText); 
                handleClickDelete();
                aprovalYa();
                aprovalTa();
               
            }
        })
    }
    const formValidation = () => {
        formSimpan.validate({
            rules: {
                beritaJudul: {
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
            submitHandler: function (e) {
                showSubmit(e);
                return false
            }
        });
    }


    const formshoww = () => {
        formShow.validate({
            rules: {
                
                beritaUnit: {
                    required: true
                }
            },
            messages : {
                beritaUnit: {
                    required: 'Judul Harus Diisi'
                }
            },
            submitHandler: function(e) {
                handleSubmit(e);
                return false
            }
        });
    }

    return {
        init: function () {
            formValidation();
            formshoww();
        }
    };
}();

KTUtil.ready(function () {
    KTBerita.init();
});