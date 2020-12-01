<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Comments
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <store-comment-form class="rounded-md bg-gray-200 shadow"/>

                    <comments-list>
                        <comments-item
                            v-for="(comment, key) in comments"
                            :key="key"
                            :comment="comment"
                        />
                    </comments-list>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import CommentsList from '@/Pages/Dashboard/CommentsList'
    import CommentsItem from '@/Pages/Dashboard/CommentsItem'
    import StoreCommentForm from '@/Pages/Dashboard/StoreCommentForm'

    export default {
        components: {
            StoreCommentForm,
            AppLayout,
            CommentsList,
            CommentsItem,
        },

        props: [
            'comments',
        ],
    }
</script>
