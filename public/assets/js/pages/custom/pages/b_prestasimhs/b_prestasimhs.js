const KTPrestasi = function () {
    const formSimpan = $('#form_upload');
    const btnSave = $('#btn_save');
    const btnSaveText = btnSave.text();

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
    
    const formValidation = () => {
        formSimpan.validate({
            rules: {
                
                prestasiTingkat: {
                    required: true
                },
                prestasiNamaMhs: {
                    required: true
                },
                prestasiNIM: {
                    required: true
                },
                prestasiProdiId: {
                    required: true
                },
                prestasiNamaKegiatan: {
                    required: true
                },
                prestasiJuara: {
                    required: true
                },
                prestasiTglKegiatan: {
                    required: true
                }
            },
            messages : {
                prestasiTingkat: {
                    required: 'Harus Diisi'
                },
                prestasiNamaMhs: {
                    required: 'Harus Diisi'
                },
                prestasiNIM: {
                    required: 'Harus Diisi'
                },
                prestasiProdiId: {
                    required: 'Harus Diisi'
                },
                prestasiNamaKegiatan: {
                    required: 'Harus Diisi'
                },
                prestasiJuara: {
                    required: 'Harus Diisi'
                },
                prestasiTglKegiatan: {
                    required: 'Harus Diisi'
                }
            },
            submitHandler: function (e) {
                showSubmit(e);
                return false
            }
        });
    }

    return {
        init: function () {
            formValidation();
            handleClickDelete();
        }
    };
}();

KTUtil.ready(function () {
    KTPrestasi.init();
});