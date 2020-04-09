<template>
    <div class="stream-chat row">
        <active-chats-component :autheduser="autheduser"></active-chats-component>
        <users-component></users-component>
    </div>
</template>

<script>
export default {
    props: ['autheduser'],
}
</script>