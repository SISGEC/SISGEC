<template>
    <div class="rich-editor-container">
        <textarea :class="'rich-editor rich-editor-'+inputID"></textarea>
        <input type="text" :name="inputName" :id="inputID">
    </div>
</template>

<script>
    import quill from '../../../node_modules/quill/quill.js';
    export default {
        mounted() {
            var editor = new Quill('.rich-editor-' + this.inputID);
            console.log("Test");
        }
    }
</script>
