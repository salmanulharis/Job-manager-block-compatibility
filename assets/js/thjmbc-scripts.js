(function($){

    $(document).ready(function(){
        $('.thjmf-job-button').addClass("wp-element-button");
        $('.thjmf-form-field').addClass("wc-block-components-text-input");
        $('.thjmf-field-text').addClass("wc-block-components-text-input");
        $('.thjmf-field-textarea textarea').addClass("wc-block-components-textarea");

        $('.thjmf-close-notification').on('click', function(){
            $(this).closest('.thjmf-form-notification').remove();
        })
        $('.thjmf-job-button').click(function(){
            $('.thjmf-form-notification').remove();
        });
    });

})(jQuery);