<template>
    <div>
        <navbar-component></navbar-component>
        <router-view></router-view>
    </div>
</template>

<script>
import NavbarComponent from '../components/NavbarComponent.vue';

export default {
    components: {
        NavbarComponent
    }
};
</script>
