import { createRouter, createWebHistory } from 'vue-router';
import BookDetails from '../js/components/BookDetails.vue';
import BookList from '../js/components/BookList.vue';
import SearchComponent from '../js/components/SearchComponent.vue';

const routes = [
    { path: '/', redirect: '/books' },

    { path: '/books', component: BookList },
    {
        path: '/books/:id',
        name: 'BookDetails',
        component: BookDetails,
        props: true
    },
    { path: '/search', component: SearchComponent },

];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
