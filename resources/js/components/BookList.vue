<template>
    <div class="book-list">
        <h2>Book List</h2>
        <ul class="list-group">
            <li class="list-group-item" v-for="book in books" :key="book.id">
                <b> Book Name: </b>  {{ book.title }} <br> <b>Author Name:</b> {{ book.author }}
            </li>

        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            books: []
        };
    },
    mounted() {
        axios.get('/api/books')
            .then(response => {
                this.books = response.data.data;
            })
            .catch(error => {
                console.error('Error fetching books:', error);
            });
    }


};
</script>

<style scoped>
.book-list {
    margin: 20px;
}
</style>
