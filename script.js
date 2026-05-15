$(document).ready(function(){

    $('#kabupaten').change(function(){

        var id_kabupaten = $(this).val();

        $.ajax({
            url: 'get_kecamatan.php',
            type: 'POST',
            data: {
                id_kabupaten: id_kabupaten
            },
            success:function(data){
                $('#kecamatan').html(data);
            }
        });

    });

    $('#kecamatan').change(function(){

        var id_kecamatan = $(this).val();

        $.ajax({
            url: 'get_desa.php',
            type: 'POST',
            data: {
                id_kecamatan: id_kecamatan
            },
            success:function(data){
                $('#desa').html(data);
            }
        });
    });
});

