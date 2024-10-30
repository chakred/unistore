export default {
    data() {
        return {
            imagePreviewURL: null,
        }
    },
    methods: {
        onFileChange(payload) {
            const file = payload.target.files[0];
            if (file) {
                this.imagePreviewURL = window.URL.createObjectURL(file);
                URL.revokeObjectURL(file); // free memory
            } else {
                this.imagePreviewURL =  null
            }
        }
    },
}

