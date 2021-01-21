<?php
$meta      = $this->meta_model->get_meta();
$page      = $this->page_model->get_page();

?>


<div class="pt-4 pt-md-5 border-top bg-white mt-auto">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo base_url(); ?>"><img class="mb-2" src="<?php echo base_url('assets/img/logo/' . $meta->logo) ?>" alt="" width="250"></a>
                <span style="font-size:18px;"><br>
                    <i class="ri-mail-send-line"></i> <?php echo $meta->email ?>
                </span>
            </div>
            <div class="col-md-3">
                <h5><?php echo $meta->title; ?></h5>
                <ul class="list-unstyled">
                    <?php foreach ($page as $page) : ?>
                        <li class="my-2"> <a class="text-muted" href="<?php echo base_url('page/detail/' . $page->page_slug); ?>"><?php echo $page->page_title; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-6 footer">
                <h5 class="text-muted">Kategori</h5>
                <ul class="list-unstyled">
                    <?php foreach ($category as $category) : ?>
                        <li> <a class="text-muted" href="#"><?php echo $category->category_name; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</div>

<div class="credit py-3">
    <div class="container">
        <div class="row d-flex justify-content-between align-items-center">
            <div class="col-md-6">
                <span>Copyright © 2019 - <?php echo date('Y') ?>, All Right Reserved</span>
            </div>
            <!-- End Col -->
            <div class="col-md-6">
                <ul class="list-inline">
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">Kebijakan Privasi</a></li>
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">Syarat dan Ketentuan</a></li>
                    <li class="list-inline-item"><a class="social-icon text-xs-center" target="_blank" href="#">Tips Aman Jual Beli</a></li>
                </ul>
            </div>
            <!-- End col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Copyright Container -->
</div>
<!-- End Copyright -->





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