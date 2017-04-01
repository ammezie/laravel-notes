<template>
    <div class="panel panel-default">
        <div class="panel-heading">Edit note</div>
        <div class="panel-body">
            <div class="form-group">
                <input type="text" class="form-control" v-model="title">
            </div>

            <div class="form-group">
                <textarea class="form-control" rows="15" v-model="body"></textarea>
            </div>

            <p>
                Users editing this note:  <span class="badge">{{ usersEditing.length }}</span>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'note',
        ],

        data() {
            return {
                title: this.note.title,
                body: this.note.body,
                usersEditing: []
            }
        },

        mounted() {
            Echo.join(`note.${this.note.slug}`)
                .here(users => {
                    this.usersEditing = users;
                })
                .joining(user => {
                    this.usersEditing.push(user);
                })
                .leaving(user => {
                    this.usersEditing = this.usersEditing.filter(u => u != user);
                });
        },

        methods: {

        }
    }
</script>
