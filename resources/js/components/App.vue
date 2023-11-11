<template>
    <div>
        <search-component></search-component>
        <router-view></router-view>
    </div>
</template>

<script>
import SearchComponent from './SearchComponent.vue';

export default {
    components: {
        SearchComponent
    }
};
</script>
