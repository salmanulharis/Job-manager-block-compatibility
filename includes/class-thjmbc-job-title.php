<?php
class THJMBCC_Job_Title {
    public function __construct() {
        add_filter('the_content', [$this, 'add_job_title'], 97);
    }

    public function add_job_title($content) {
        if (is_singular('thjm_jobs')) {
            $title_path = THJMBC_PLUGIN_DIR . 'templates/title.php';
            $custom_title = '';

            if (file_exists($title_path)) {
                ob_start();
                
                $job_title_arg = THJMF_Utils::get_job_title_args(get_the_ID());
                if (!empty($job_title_arg)) {
                    extract($job_title_arg);
                }
                include $title_path;

                $custom_title = ob_get_clean();
            }

            $content = $custom_title . $content;
        }
        return $content;
    }
}
