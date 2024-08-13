<?php
class THJMBCC_Job_Notice {
    public function __construct() {
        add_filter('the_content', [$this, 'add_job_notice'], 101);
    }

    public function add_job_notice($content) {
        if (is_singular('thjm_jobs')) {
            $submission = isset($_GET['submit']) ? sanitize_text_field($_GET['submit']) : '';

            if (!empty($submission)) {
                ob_start();
                ?>
                <div class="thjmf-form-notification thjmf-notification-<?php echo esc_attr($submission); ?>">
                    <?php if ($submission == "success"): ?>
                        <span class="dashicons dashicons-yes thjmf-notification-icon"></span>
                        <p><?php echo esc_html__('Application Submitted Successfully', 'job-manager-career'); ?></p>
                    <?php elseif ($submission == "error"): ?>
                        <span class="dashicons dashicons-no thjmf-notification-icon"></span>
                        <p><?php echo esc_html__('An error occurred while submitting the application. Try again', 'job-manager-career'); ?></p>
                    <?php endif; ?>
                    <span class="dashicons dashicons-no-alt thjmf-close-notification"></span>
                </div>
                <?php
                $notification_content = ob_get_clean();
                $content = $content . $notification_content;
            }
        }

        return $content;
    }
}
