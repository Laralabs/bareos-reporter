(function($){
    $(document).ready(function(){
        var driver = $('#driver_check').val();

        if(driver == 'mysql')
        {
            $('#mysql-wrap').show();
            $('#pgsql-wrap').hide();
            $('#sqlite-wrap').hide();
            $('#driver-select').on('change', function() {
                if(this.value == 'mysql')
                {
                    $('#mysql-wrap').show();
                    $('#sqlite-wrap').hide();
                    $('#pgsql-wrap').hide();
                }
                else if(this.value == 'pgsql')
                {
                    $('#mysql-wrap').hide();
                    $('#sqlite-wrap').hide();
                    $('#pgsql-wrap').show();
                }
                else if(this.value == 'sqlite')
                {
                    $('#mysql-wrap').hide();
                    $('#pgsql-wrap').hide();
                    $('#sqlite-wrap').show();
                }
            })
        }
        else if(driver == 'pgsql')
        {
            $('#pgsql-wrap').show();
            $('#sqlite-wrap').hide();
            $('#mysql-wrap').hide();
            $('#driver-select').on('change', function() {
                if(this.value == 'mysql')
                {
                    $('#mysql-wrap').show();
                    $('#sqlite-wrap').hide();
                    $('#pgsql-wrap').hide();
                }
                else if(this.value == 'pgsql')
                {
                    $('#mysql-wrap').hide();
                    $('#sqlite-wrap').hide();
                    $('#pgsql-wrap').show();
                }
                else if(this.value == 'sqlite')
                {
                    $('#mysql-wrap').hide();
                    $('#pgsql-wrap').hide();
                    $('#sqlite-wrap').show();
                }
            })
        }
        else if(driver == 'sqlite')
        {
            $('#pgsql-wrap').hide();
            $('#mysql-wrap').hide();
            $('#sqlite-wrap').show();
            $('#driver-select').on('change', function() {
                if(this.value == 'mysql')
                {
                    $('#mysql-wrap').show();
                    $('#sqlite-wrap').hide();
                    $('#pgsql-wrap').hide();
                }
                else if(this.value == 'pgsql')
                {
                    $('#mysql-wrap').hide();
                    $('#sqlite-wrap').hide();
                    $('#pgsql-wrap').show();
                }
                else if(this.value == 'sqlite')
                {
                    $('#mysql-wrap').hide();
                    $('#pgsql-wrap').hide();
                    $('#sqlite-wrap').show();
                }
            })
        }
        else
        {
            $('#pgsql-wrap').hide();
            $('#sqlite-wrap').hide();
            $('#driver-select').on('change', function() {
                if(this.value == 'mysql')
                {
                    $('#mysql-wrap').show();
                    $('#sqlite-wrap').hide();
                    $('#pgsql-wrap').hide();
                }
                else if(this.value == 'pgsql')
                {
                    $('#mysql-wrap').hide();
                    $('#sqlite-wrap').hide();
                    $('#pgsql-wrap').show();
                }
                else if(this.value == 'sqlite')
                {
                    $('#mysql-wrap').hide();
                    $('#pgsql-wrap').hide();
                    $('#sqlite-wrap').show();
                }
            })
        }
    });

    /**
     * When the active director select dropdown changes
     * submit the form value.
     */
    $('#director-select').on('changed.bs.select', function(e) {
        $('#director-select-form').submit();
    })
})(jQuery);