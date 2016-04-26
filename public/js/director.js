(function($){
    $(document).ready(function(){
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
    });
})(jQuery);