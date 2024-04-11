<template>
    <div class="d-flex justify-content-center align-items-center">

    <div class=""
        style="
    float: left;
    display: grid;
    place-items: flex-start;">

    <i
        :class="`material-icons text-white ${addClass ? addClass : ''} text-shaka-subtitle`"
        @mouseover="isActive ? isActive = !isActive : ''"
        @mouseout="active !== '' && !isActive ? isActive = !isActive : ''">

         {{ isActive ? 'favorite_border' : 'favorite' }}
    </i>

    </div>
        <span class="pl-2" @mouseover="isActive ? isActive = !isActive : ''"
              @mouseout="active !== '' && !isActive ? isActive = !isActive : ''">Add to wishlist</span>
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