<!-- <?php
if ($product->is_type('variable')) {
    foreach ($product->get_available_variations() as $variation_data) {
        $variation = new WC_Product_Variation($variation_data['variation_id']);
        $downloadable_files = $variation->get_downloads();
        if (!empty($downloadable_files)) {
            foreach ($downloadable_files as $file) {
                $file_url = $file['file'];
                if (pathinfo($file_url, PATHINFO_EXTENSION) !== 'pdf') {
                    $file_url .= '.pdf';
                }
                ?>
                <tr class="gallery-item">
                    <td>
                        <a href="<?php echo $file_url; ?>" download class="download-button">
                            Download <?php echo $file['name']; ?> (PDF)
                        </a>
                    </td>
                </tr>
                <?php
            }
        }
    }
} else {
    ?>
    <tr>
        <td colspan="2">This product does not have variations.</td>
    </tr>
    <?php
}
?> -->