<template>
    <div>
        <div class="tabs">
            <ul class="nav nav-pills d-sm-grid d-md-flex flex-lg-row" style="font-size: 16px; line-height: 20px">
                <li v-for="tab in tabs" :class="{ 'bg-shaka-primary': tab.isActive  }" class="btn rounded mr-lg-3 cursor-pointer nav-item" style="padding: 0" @click="selectTab(tab)">
                    <a class="nav-link">{{ tab.name }}</a>
                </li>
            </ul>
        </div>

        <div class="tabs-content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                tabs: []
            }
        },

        created() {
            this.tabs = this.$children;
        },

        methods: {
            selectTab(selectedTab) {
                this.tabs.forEach(tab => {
                    tab.isActive = (tab.name == selectedTab.name);
                });
            }
        }
    }
</script>