<template>
    <form class="flex flex-row p-4" @submit.prevent="store">
        <div class="flex flex-col w-3/4">
            <jet-input
                id="text"
                type="text"
                class="mt-1 block w-full"
                :class="form.error('text') ? 'border-red-400' : ''"
                placeholder="Type here.."
                v-model="form.text"
                ref="text"
                autocomplete="text"
            />
        </div>

        <div class="flex flex-row ml-6 w-1/4">
            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Publish
            </jet-button>

            <jet-action-message :on="form.recentlySuccessful" class="ml-3">
                Published.
            </jet-action-message>
        </div>
    </form>
</template>

<script>
    import JetActionMessage from '@/Jetstream/ActionMessage'
    import JetButton from '@/Jetstream/Button'
    import JetInput from '@/Jetstream/Input'

    export default {
        components: {
            JetActionMessage,
            JetButton,
            JetInput,
        },

        props: {
            commentId: {
                type: Number,
                default: null
            },
        },

        data() {
            return {
                form: this.$inertia.form({
                    text: '',
                    comment_id: this.commentId,
                }, {
                    bag: 'storeComment',
                }),
            }
        },

        methods: {
            store() {
                this.form.post(route('comments.store'), {
                    preserveScroll: true
                }).then(() => {
                    this.$emit('submitted')
                })
            },
        },
    }
</script>
