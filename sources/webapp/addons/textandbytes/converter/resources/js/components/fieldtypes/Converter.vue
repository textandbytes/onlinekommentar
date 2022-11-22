<template>

    <div>
        <input
            hidden
            type="file"
            accept="text/html"
            ref="input"
            @input="select" />
        <button type="button" class="btn btn-with-icon" @click.prevent="browse" :disabled="converting">
            <svg-icon name="upload" class="w-6 h-6 text-grey-80"></svg-icon>
            {{ __('Import Document') }}
        </button>
    </div>

</template>

<script>
export default {

    mixins: [Fieldtype],

    data() {
        return {
            file: null,
            converting: false,
        };
    },

    computed: {

        store() {
            let store;
            let parent = this;

            while (! parent.storeName) {
                parent = parent.$parent;
                store = parent.storeName;
                if (parent === this.$root) return null;
            }
           
            return this.$store.state.publish[store];
        },

    },

    methods: {

        browse() {
            this.$refs.input.click();
        },

        select() {
            const file = this.$refs.input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => {
                    const html = ev.target.result
                        .replace('charset=windows-1252', 'charset=utf-8');
                    this.convert(html);
                };
                reader.readAsText(file, 'windows-1252');
            }
        },

        convert(html) {
            this.converting = true;
            this.$progress.start('convert' + this._uid);
            this.$axios.post(cp_url('converter/convert'), {
                html
            }).then(response => {
                const values = response.data;
                this.store.values.content = JSON.stringify(values.data);
            }).catch(e => {
            }).finally(e => {
                this.converting = false;
                this.$progress.complete('convert' + this._uid);
                this.$refs.input.value = null;
            })
        },

    }

};
</script>