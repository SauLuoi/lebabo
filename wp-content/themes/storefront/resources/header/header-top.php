<?php
$h_header_top = get_field('h_header_top', 'option');

$contentTopBanner = [];
if (!empty($h_header_top)) {
    foreach ($h_header_top as $h_header_text) {
        $contentTopBanner[] = $h_header_text['h_header_top_text'];
    }
}
?>

<?php if (!empty($h_header_top)) { ?>
    <div class="top-banner">
        <span class="top-banner-text"><?php echo $contentTopBanner[0]; ?></span>
    </div>
<?php } ?>

<script>
    jQuery(document).ready(function () {
        function changeContentTopBanner() {
            var contentArr = <?php echo json_encode($contentTopBanner); ?>;
            var i = 1;
            setInterval(function () {
                var topBannerCurr = contentArr[i];
                jQuery('.top-banner > span').html(topBannerCurr);
                if (i === contentArr.length - 1) {
                    i = 0
                } else {
                    i++;
                }

            }, 3000);
        };

        changeContentTopBanner();
    })
</script>