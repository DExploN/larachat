<template>
    <div>
        <div class="card mb-3" v-for="(message) in messages">
            <div class="card-body">
                <h5 class="card-title">{{message.user.name}}</h5>
                <small class="text-muted mb-1">{{message.created_at}}</small>
                <div class="card-text">{{message.text}}</div>
            </div>
        </div>
        <form class="mt-3" id="message_form" @submit.prevent="sendMessage">
            <input type="text" class="form-control" :class="{'is-invalid':isError}" name="text" v-model="new_message"/>
            <div class="invalid-feedback">
                {{error}}
            </div>
            <button type="submit" class="btn btn-primary mt-3">Отправить</button>
        </form>
    </div>
</template>
<script>
    export default {
        props: [
            'routes',
            'room'
        ],
        data: function () {
            return {
                'messages': [],
                'new_message': '',
                'error': '',
                'isError': false
            }
        },
        mounted() {
            this.updateMessages();
            Echo.channel('laravel_database_chat_' + this.room)
                .listen('SendMessageEvent', (e) => {
                    this.updateMessages();
                });
        },
        methods: {
            'updateMessages': function () {
                axios.get(this.routes.messages).then(response => {
                    this.messages = response.data
                })
            },
            'sendMessage': function () {
                this.isError = false;
                axios({
                    'url': this.routes.store,
                    'method': 'post',
                    'data': {'text': this.new_message}
                }).then(response => {
                    this.isError = false;
                    this.new_message = '';
                }).catch(errors => {
                    this.error = errors.response.data['errors'].text[0];
                    this.isError = true;
                })
            }
        }
    }
</script>
