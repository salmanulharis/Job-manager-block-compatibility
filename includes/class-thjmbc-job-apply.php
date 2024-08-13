<?php
class THJMBCC_Job_Apply {
    public function __construct() {
        add_filter('the_content', [$this, 'add_job_apply_button'], 99);
    }

    public function add_job_apply_button($content) {
        if (is_singular('thjm_jobs') && thjmf_is_appliable_job()) {
            $custom_content = '<div><button class="button thjmf-job-button" id="thjmf_show_form">';
            $custom_content .= esc_html__('Apply Now', 'job-manager-career');
            $custom_content .= '</button></div>';
            $content .= $custom_content;
        }

        return $content;
    }
}
