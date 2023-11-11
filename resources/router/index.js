import { createRouter, createWebHistory } from 'vue-router';
import BookDetails from '../js/components/BookDetails.vue';
import BookList from '../js/components/BookList.vue';

const routes = [
    { path: '/books', component: BookList },
    {
        path: '/books/:id',
        name: 'BookDetails',
        component: BookDetails,
        props: true
    }    // ... other routes ...
];


const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
