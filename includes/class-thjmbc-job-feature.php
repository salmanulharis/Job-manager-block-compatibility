<?php
class THJMBCC_Job_Feature {
    public function __construct() {
        add_filter('the_content', [$this, 'add_job_feature'], 98);
    }

    public function add_job_feature($content) {
        if (is_singular('thjm_jobs')) {
            $features_path = THJM_PLUGIN_URL . '/templates/single-jobs/features.php';
            $custom_content = '';

            if (file_exists($features_path)) {
                ob_start();
                $details = [];

                $features = isset(THJMF_SETTINGS['job_detail']['job_feature']['job_def_feature']) ? THJMF_SETTINGS['job_detail']['job_feature']['job_def_feature'] : [];
                if (is_array($features)) {
                    foreach ($features as $feature_key => $feature_label) {
                        $details[$feature_key] = THJMF_Utils::get_post_metas(get_the_ID(), $feature_key, true);
                    }
                }

                if (!empty($features) && !empty($details)) {
                    extract(['features' => $features, 'details' => $details]);
                }

                include $features_path;
                $custom_content .= ob_get_clean();
            }

            $content = $custom_content . $content;
        }
        return $content;
    }
}
