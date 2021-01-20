<?php
$meta      = $this->meta_model->get_meta();

?>

<section class="bantuan py-md-3 mt-md-5">
    <div class="container">
        <div class="row">
            <div class="col-md-8 text-light"><span style="font-size:35px;font-weight:700;">Jual, beli, Sewa Property disini</span></div>
            <div class="col-md-4 text-light"><span style="font-size:30px;font-weight:700;"></span></div>
        </div>
    </div>
</section>
<div class="pt-4 pt-md-5 pb-md-5 border-top bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md">
                <a href="<?php echo base_url(); ?>"><img class="mb-2" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>" alt="" width="250"></a>
                <span style="font-size:18px;"><br>
                    <i class="ri-mail-send-line"></i> <?php echo $meta->email ?>
                </span>
            </div>
            <div class="col-6 col-md ml-md-5">
                <h5>Halaman</h5>
                <ul class="list-unstyled text-small">

                    <li><i class="ri-arrow-right-s-line"></i> <a class="text-muted" href="#">Berita Property</a></li>
                    <li><i class="ri-arrow-right-s-line"></i> <a class="text-muted" href="#">Cari Agen Property</a></li>
                    <li><i class="ri-arrow-right-s-line"></i> <a class="text-muted" href="#">Pasang Iklan Gratis</a></li>

                </ul>
            </div>
            <div class="col-5 col-md">
                <h5>Griya Niaga</h5>
                <ul class="list-unstyled text-small">
                    <li><i class="ri-arrow-right-s-line"></i> <a class="text-muted" href="<?php echo base_url('contact') ?>">Tentang Kami</a></li>
                    <li><i class="ri-arrow-right-s-line"></i> <a class="text-muted" href="<?php echo base_url('contact') ?>">Hubungi Kami</a></li>
                    <li><i class="ri-arrow-right-s-line"></i> <a class="text-muted" href="<?php echo base_url('contact') ?>">Kebijakan Privasi</a></li>
                    <li><i class="ri-arrow-right-s-line"></i> <a class="text-muted" href="<?php echo base_url('contact') ?>">Syarat Penggunaan</a></li>
                </ul>
            </div>

        </div>
    </div>
</div>
<footer class="credit text-center mt-auto text-light py-md-3">Copyright &copy; <?php echo date('Y') ?> - <?php echo $meta->title ?> - <?php echo $meta->tagline ?></footer>
<!-- Load javascript Jquery -->
<script src="<?php echo base_url() ?>assets/template/front/vendor/jquery/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/template/front/vendor/offcanvas/offcanvas.js" type="text/javascript"></script>




<script>
    $(function() {
        $('#id_tanggal').datetimepicker({
            locale: 'id',
            format: 'D MMMM YYYY',
            minDate: new Date(),
        });
    });
    $('.form-control-chosen').chosen({});
    $('#timepicker').timepicker();
</script>

<script>
    $(function() {
        $('#id_tanggal_bayar').datetimepicker({
            locale: 'id',
            format: 'D MMMM YYYY'
        });
    });
</script>



<!-- Google Analitycs -->
<?php echo $meta->google_analytics; ?>
<!-- End Google Analitycs -->


<!-- SUMMERNOTE -->
<link href="<?php echo base_url('assets/template/admin/js/summernote/summernote-lite.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/template/admin/js/summernote/summernote-lite.min.js'); ?>"></script>

<script>
    $('#summernote').summernote({
        placeholder: 'Deskripsi',
        tabsize: 2,
        height: 130,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });
</script>



<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/template/front/vendor/slick/slick.min.js"></script>

<script>
    $('.responsive').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 6,
        slidesToScroll: 4,
        responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 3,
                    infinite: true,
                    dots: true
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
</script>


<link href="<?php echo base_url(); ?>assets/template/front/vendor/select2/css/select2.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/template/front/vendor/select2/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>

<!-- Gambar -->
<script>
    $('input[type="file"]').each(function() {
        // Refs
        var $file = $(this),
            $label = $file.next('label'),
            $labelText = $label.find('span'),
            labelDefault = $labelText.text();

        // When a new file is selected
        $file.on('change', function(event) {
            var fileName = $file.val().split('\\').pop(),
                tmppath = URL.createObjectURL(event.target.files[0]);
            //Check successfully selection
            if (fileName) {
                $label
                    .addClass('file-ok')
                    .css('background-image', 'url(' + tmppath + ')');
                $labelText.text(fileName);
            } else {
                $label.removeClass('file-ok');
                $labelText.text(labelDefault);
            }
        });

        // End loop of file input elements
    });
</script>



</body>

</html>