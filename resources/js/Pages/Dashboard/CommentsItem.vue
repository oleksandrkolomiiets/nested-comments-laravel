<template>
    <div>
        <div class="p-4 mt-2 rounded-lg bg-blue-100 flex justify-between">
            <div>
                <div>
                    <button
                        v-if="canDelete"
                        type="button"
                        class="text-red-400 text-xs px-2"
                        @click="remove"
                    >
                        Delete
                    </button>

                    <sup>
                        (#{{ comment.user.id }})
                    </sup>

                    <span>{{ comment.user.name }}</span>
                </div>
                <div>
                    <span class="text-xs text-gray-700">{{ comment.created_at }}</span>
                    <span class="text-lg">{{ comment.text }}</span>
                </div>
            </div>
            <button
                type="button"
                :class="replying ? 'text-green-400' : ''"
                @click="toggleReplying"
            >
                Reply
            </button>
        </div>

        <store-comment-form
            v-if="replying"
            :comment-id="comment.id"
            @submitted="toggleReplying"
        />

        <sub-comments-list v-if="comment.comments.length">
            <comments-item
                v-for="(comment, key) in comment.comments"
                :key="key"
                :comment="comment"
            />
        </sub-comments-list>
    </div>
</template>

<script>
    import SubCommentsList from '@/Pages/Dashboard/SubCommentsList'
    import CommentsItem from '@/Pages/Dashboard/CommentsItem'
    import StoreCommentForm from '@/Pages/Dashboard/StoreCommentForm'

    export default {
        name: 'comments-item',

        components: {
            SubCommentsList,
            CommentsItem,
            StoreCommentForm,
        },

        props: {
            comment: {
                type: Object,
                required: true,
            },
        },

        data() {
            return {
                form: this.$inertia.form({
                    '_method': 'DELETE',
                }),
                replying: false,
            }
        },

        computed: {
            canDelete() {
                return this.comment.user_id === this.$page.user.id
            },
        },

        methods: {
            remove() {
                this.form.post(route('comments.destroy', {comment: this.comment.id}), {
                    preserveScroll: true
                }).then(() => {
                    this.$emit('destroyed', this.comment)
                })
            },

            toggleReplying() {
                this.replying = !this.replying
            },
        }
    }
</script>
