<?php
class THJMBCC_Job_Main_Wrapper {
    public function __construct() {
        add_filter('the_content', [$this, 'wrap_job_content'], 100);
    }

    public function wrap_job_content($content) {
        if (is_singular('thjm_jobs')) {
            $start = '<div id="thjmf_job-' . esc_attr(get_the_ID()) . '" class="' . esc_attr(thjmf_get_single_job_wrapper_class()) . '">';
            $end = '</div>';

            $content = $start . $content . $end;
        }
        return $content;
    }
}
