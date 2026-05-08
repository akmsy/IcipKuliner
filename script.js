$(document).ready(function(){

    $('#provinsi').change(function(){

        var id_provinsi = $(this).val();

        $.ajax({
            url: 'get_kabupaten.php',
            type: 'POST',
            data: {
                id_provinsi: id_provinsi
            },
            success:function(data){
                $('#kabupaten').html(data);
            }
        });

    });

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
});

