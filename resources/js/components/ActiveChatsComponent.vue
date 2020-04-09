<template>
    <div class="active-chats row">
         <message-component 
            v-for="chat in activeChats" 
            :key="chat.id"
            :token="token"
            :client="client"
            :chat="chat"
            :autheduser="autheduser">
         </message-component>
    </div>
</template>

<script>
import { StreamChat } from 'stream-chat';
export default {
    props: ['autheduser'],
    data () {
        return {
            activeChats: [],
            client: null,
            token: null,
            MAX_NO_CHAT_HEAD: 3
        }
    },
    created() {
        this.EventBus.$on('newActiveChat', user => {
            // check if the user chat is already present
            const chat = this.activeChats.find(chat => chat.email == user.email)
            if (!chat) {
                this.activeChats.push(user)
                // remove the first chat head if the number of chat head is 
                // greater than the MAX_NO_CHAT_HEAD
                if (this.activeChats.length > this.MAX_NO_CHAT_HEAD) {
                    this.activeChats.shift() 
                }
            } 
        })

        this.initializeClient()
    },
    methods: {
            async initializeClient () {
            // Initialize the StreamChat SDK
            const {data} = await axios.post('/api/generate-token', {
                username: this.autheduser.email.replace(/[@\.]/g, '_')
            })

            const client = new StreamChat(process.env.MIX_STREAM_API_KEY, {timeout: 9000});
            await client.setUser(
                {
                    id: this.autheduser.email.replace(/[@\.]/g, '_'),
                    name: this.autheduser.name,
                },
                data.token,
            );

            this.client = client
        },
    }
}
</script>