<template>
    <div class="panel panel-default">
        <div class="panel-heading">Edit note</div>
        <div class="panel-body">
            <div class="form-group">
                <input type="text" class="form-control" v-model="title" @keydown="editingNote">
            </div>

            <div class="form-group">
                <textarea class="form-control" rows="15" v-model="body" @keydown="editingNote"></textarea>
            </div>

            <button class="btn btn-primary pull-right" @click="updateNote">Save</button>

            <p>
                Users editing this note:  <span class="badge">{{ usersEditing.length }}</span>
                <span class="label label-success" v-text="status"></span>
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
                usersEditing: [],
                status: ''
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
                })
                .listenForWhisper('editing', (e) => {
                    this.title = e.title;
                    this.body = e.body;
                })
                .listenForWhisper('saved', (e) => {
                    this.status = e.status;

                    // clear is status after 1s
                    setTimeout(() => {
                        this.status = '';
                    }, 1000);
                });
        },

        methods: {
            editingNote() {
                let channel = Echo.join(`note.${this.note.slug}`);

                // show changes after 1s
                setTimeout(() => {
                    channel.whisper('editing', {
                        title: this.title,
                        body: this.body
                    });
                }, 1000);
            },

            updateNote() {
                let note = {
                    title: this.title, 
                    body:  this.body
                };

                // persist to database
                axios.patch(`/edit/${this.note.slug}`, note)
                    .then(response => {
                        // show saved status
                        this.status = response.data;
                         
                        // clear is status after 1s
                        setTimeout(() => {
                            this.status = '';
                        }, 1000);

                        // show saved status to others
                        Echo.join(`note.${this.note.slug}`)
                            .whisper('saved', {
                                status: response.data
                            });
                    });
            }
        }
    }
</script>
