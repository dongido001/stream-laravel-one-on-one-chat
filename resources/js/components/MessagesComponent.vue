<template> 
    <div class="card user-box">
        <div class="card-header" @click="collapsed = !collapsed"> 
            {{ chat.name }}
        </div>
        <div class="card-body" v-show="!collapsed">
            <div class="user-messages">
                <div
                    class="chat-message" 
                    v-for="message in messages" 
                    :key="message.id"
                    :class="[(message.user.id == username) ? 'from-client' : 'from-admin']"
                >
                    {{ message.text }}
                </div>
            </div>
            <div class="input-container">
                <input
                    class="chat-input" 
                    type="text" 
                    placeholder="enter message..." 
                    v-model="message"
                    v-on:keyup.enter="addMessage"
                    @enter="addMessage"
                >
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['client', 'chat', 'autheduser'],
    data() {
        return {
            message: "",
            messages: [],
            collapsed: false,
            channel: null
        }
    },
    computed: {
        username() {
            return this.autheduser.email.replace(/[@\.]/g, '_')
        }
    },
    async created() {
        const to_username = this.chat.email.replace(/[@\.]/g, '_')
         
        // Initialize the channel
        const channel = this.client.channel('messaging', {
            name: 'Awesome channel',
            members: [this.username, to_username]
        });

        this.channel = channel

        // fetch the channel state, subscribe to future updates
        channel.watch().then(state => {
            this.messages = state.messages
            
            // Listen for new messages on the channel
            channel.on('message.new', event => {
                this.messages.push(event.message)
            });
        })
    },
    methods: {
        addMessage() {
            // Send message to the channel
            this.channel && this.channel.sendMessage({
                text: this.message
            });
            
            this.message = "";
        }
    }
}
</script>