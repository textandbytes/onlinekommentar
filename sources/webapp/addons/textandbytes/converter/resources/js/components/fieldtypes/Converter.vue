<template>

    <div class="flex">
        <input
            hidden
            type="file"
            accept="text/html"
            ref="input"
            @input="selectHtml" />
        <button type="button" class="btn btn-with-icon" @click="browseHtml" :disabled="converting">
            <svg-icon name="upload" class="w-6 h-6 text-gray-80"></svg-icon>
            {{ __('Import HTML') }}
        </button>
        <button type="button" class="btn btn-with-icon ml-auto" @click="convertEntryToWord" :disabled="converting">
            <svg-icon name="light/download" class="w-6 h-6 text-gray-80"></svg-icon>
            {{ __('Export Word') }}
        </button>
        <button type="button" class="btn btn-with-icon ml-2" @click="convertEntryToPdf" :disabled="converting">
            <svg-icon name="light/download" class="w-6 h-6 text-gray-80"></svg-icon>
            {{ __('Export PDF') }}
        </button>
    </div>

</template>

<script>
export default {

    mixins: [Fieldtype],

    inject: ['storeName'],

    data() {
        return {
            file: null,
            converting: false,
        };
    },

    computed: {

        store() {           
            return this.$store.state.publish[this.storeName];
        },

    },

    methods: {

        browseHtml() {
            this.$refs.input.click();
        },

        selectHtml() {
            const file = this.$refs.input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    const html = ev.target.result
                        .replace('charset=windows-1252', 'charset=utf-8');
                    this.convertHtmlToProsemirror(html);
                };
                reader.readAsText(file, 'windows-1252');
            }
        },

        convertHtmlToProsemirror(html) {
            this.converting = true;
            this.$progress.start('convert' + this._uid);
            this.$axios.post(cp_url('converter/html-prosemirror'), {
                html
            }).then(response => {
                const values = response.data;
                this.store.values.content = values.data;
            }).catch(e => {
            }).finally(e => {
                this.converting = false;
                this.$progress.complete('convert' + this._uid);
                this.$refs.input.value = null;
            })
        },

        convertProsemirrorToWord() {
            this.converting = true;
            this.$progress.start('convert' + this._uid);
            this.$axios.post(cp_url('converter/prosemirror-word'), {
                id: this.store.values.id,
                data: this.store.values.content,
            }, { responseType: 'blob' }).then(response => {
                this.downloadFile(response);
            }).catch(e => {
            }).finally(e => {
                this.converting = false;
                this.$progress.complete('convert' + this._uid);
            })
        },

        convertEntryToWord() {
            this.converting = true;
            this.$progress.start('convert' + this._uid);
            this.$axios.post(cp_url(`converter/entry-word`), {
                id: this.store.values.id,
            }, { responseType: 'blob' }).then(response => {
                this.downloadFile(response);
            }).catch(e => {
            }).finally(e => {
                this.converting = false;
                this.$progress.complete('convert' + this._uid);
            })
        },

        convertEntryToPdf() {
            this.converting = true;
            this.$progress.start('convert' + this._uid);
            this.$axios.post(cp_url(`converter/entry-pdf`), {
                id: this.store.values.id,
            }, { responseType: 'blob' }).then(response => {
                this.downloadFile(response);
            }).catch(e => {
            }).finally(e => {
                this.converting = false;
                this.$progress.complete('convert' + this._uid);
            })
        },

        downloadFile(response) {
            const file = response.headers['content-disposition'].match(/^attachment.+filename\*?=(?:UTF-8'')?"?([^"]+)"?/i)[1];
            const url = window.URL.createObjectURL(new Blob([response.data]));
            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', file);
            document.body.appendChild(link);
            link.click();
        },

    }

};
</script>

<style scoped>
    .ml-auto {
        margin-left: auto;
    }
</style>