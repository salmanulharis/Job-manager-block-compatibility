<?php
class THJMBCC_Job_Form {
    public function __construct() {
        add_filter('the_content', [$this, 'add_job_application_form'], 100);
    }

    public function add_job_application_form($content) {
        if (is_singular('thjm_jobs')) {
            if (!thjmf_is_filled_job() && !thjmf_is_expired_job() && !thjmf_has_application_form()) {
                $content .= '<div class="thjmf-apply-now-msg">' . esc_html(thjmf_get_apply_now_message()) . '</div>';
                return $content;
            }

            if (!thjmf_is_appliable_job()) {
                return $content;
            }

            $form_content = '<form name="thjmf_job_application" id="thjmf_job_application" method="post" enctype="multipart/form-data" class="' . esc_attr(thjmf_get_apply_form_class()) . '">';
            $form_content .= '<input type="hidden" name="thjmf_job_id" value="' . esc_attr(get_the_ID()) . '">';

            if (function_exists('wp_nonce_field')) {
                $form_content .= wp_nonce_field('thjmf_new_job_application', 'thjmf_application_meta_nonce', true, false);
            }

            $job_application_path = THJM_PLUGIN_URL . '/templates/single-jobs/job-application.php';

            if (file_exists($job_application_path)) {
                ob_start();
                include $job_application_path;
                $form_content .= ob_get_clean();
            }

            $form_content .= '</form>';

            $content .= $form_content;
        }

        return $content;
    }
}
