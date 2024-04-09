<template>
    <div>
        <div class="tabs">
            <ul class="nav nav-pills nav-fill d-flex flex-sm-column flex-lg-row ">
                <li v-for="tab in tabs" :class="{ 'bg-shaka-primary': tab.isActive  }" class="border rounded cursor-pointer nav-item" @click="selectTab(tab)">
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