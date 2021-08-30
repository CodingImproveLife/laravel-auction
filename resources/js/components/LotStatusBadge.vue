<template>
    <span :class="badgeColor">
        {{ lotStatus }}
    </span>
</template>

<script>
    export default {
        props: ['status'],
        data() {
            return {
                lotStatus: this.status,
            }
        },
        computed: {
            badgeColor() {
                return {
                    'text-red-100 bg-red-600': this.lotStatus === 'On sale',
                    'text-green-100 bg-green-600': this.lotStatus === 'Sold',
                    'text-gray-100 bg-gray-600': this.lotStatus === 'Draft',
                }
            }
        },
    }
</script>
