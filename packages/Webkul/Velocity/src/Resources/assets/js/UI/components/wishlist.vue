<template>
    <div class="rounded-circle bg-shaka-light"
        style="height: 43px;
    width: 43px;
    float: right;
    display: grid;
    place-items: center;">

    <i
        :class="`material-icons text-white ${addClass ? addClass : ''} text-shaka-subtitle`"
        @mouseover="isActive ? isActive = !isActive : ''"
        @mouseout="active !== '' && !isActive ? isActive = !isActive : ''">

         {{ isActive ? 'favorite_border' : 'favorite' }}
    </i>
    </div>
</template>

<script type="text/javascript">
    export default {
        props: [
            'active',
            'addClass',
        ],

        data: function () {
            return {
                isActive: this.active,
            }
        }
    }
</script>