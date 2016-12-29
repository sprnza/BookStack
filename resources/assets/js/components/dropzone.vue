<template>
    <div class="dropzone-container"><div class="dz-message" v-text="message"></div></div>
</template>
<script>
    export default {
        template: '',
        props: ['uploadUrl', 'uploadedTo', 'message', 'eventSuccess', 'eventError'],
        data: function() {
            return {}
        },
        mounted: function() {
            let _this = this;
            new DropZone(_this.$el, {
                url: _this.uploadUrl,
                init: function () {
                    let dz = this;
                    dz.on('sending', function (file, xhr, data) {
                        let token = window.document.querySelector('meta[name=token]').getAttribute('content');
                        data.append('_token', token);
                        let uploadedTo = typeof _this.uploadedTo === 'undefined' ? 0 : _this.uploadedTo;
                        data.append('uploaded_to', uploadedTo);
                    });
                    if (typeof _this.eventSuccess !== 'undefined') dz.on('success', _this.eventSuccess);
                    dz.on('success', function (file, data) {
                        $(file.previewElement).fadeOut(400, function () {
                            dz.removeFile(file);
                        });
                    });
                    if (typeof _this.eventError !== 'undefined') dz.on('error', _this.eventError);
                    dz.on('error', function (file, errorMessage, xhr) {
                        console.log(errorMessage);
                        console.log(xhr);
                        function setMessage(message) {
                            $(file.previewElement).find('[data-dz-errormessage]').text(message);
                        }

                        if (xhr.status === 413) setMessage('The server does not allow uploads of this size. Please try a smaller file.');
                        if (errorMessage.file) setMessage(errorMessage.file[0]);

                    });
                }
            });
        }
    }
</script>
