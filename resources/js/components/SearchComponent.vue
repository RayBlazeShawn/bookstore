<template>
    <div class="container my-4">
        <form @submit.prevent="searchBooks" class="row g-3">
            <div class="col-auto">
                <input v-model="search.title" class="form-control" placeholder="Search by title">
            </div>
            <div class="col-auto">
                <input v-model="search.author" class="form-control" placeholder="Search by author">
            </div>
            <div class="col-auto">
                <input v-model="search.isbn" class="form-control" placeholder="Search by ISBN">
            </div>
            <div class="col-auto">
                <input v-model="search.genre" class="form-control" placeholder="Search by Genre">
            </div>
            <div class="col-auto">
                <input v-model="search.publication_date" class="form-control" type="date" placeholder="Search by Publication Date">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3" :disabled="loading">
                    <span v-if="loading">Searching...</span>
                    <span v-else>Search</span>
                </button>
            </div>
        </form>

        <div v-if="noResults" class="alert alert-warning" role="alert">
            No results found.
        </div>

        <div class="search-results mt-4">
            <ul class="list-group">
                <li v-for="book in books" :key="book.id" class="list-group-item">
                    <h5><strong>{{ book.title }}</strong></h5>
                    <p>Author: {{ book.author }}</p>
                    <p>ISBN: {{ book.isbn }}</p>
                    <p>Genre: {{ book.genre }}</p>
                    <p>Published Date: {{ formatDate(book.publication_date) }}</p>

                    <button @click="viewBookDetails(book.id)" class="btn btn-info">View Details</button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            search: {
                title: '',
                author: '',
                isbn: '',
                genre: '',
                publication_date: '', // added publication_date
            },
            books: [],
            loading: false,
            noResults: false,
        };
    },
    methods: {
        searchBooks() {
            this.loading = true;

            // Prepare the parameters, including only non-empty fields
            const params = Object.keys(this.search).reduce((acc, key) => {
                if (this.search[key]) {
                    acc[key] = this.search[key];
                }
                return acc;
            }, {});

            axios.get('/api/books', { params })
                .then(response => {
                    this.books = response.data.data;
                    this.noResults = this.books.length === 0;
                })
                .catch(error => {
                    console.error('Search error:', error);
                    this.noResults = true;
                })
                .finally(() => {
                    this.loading = false;
                });


        },

        formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' }; // Example format
            return new Date(dateString).toLocaleDateString(undefined, options);
        },

        viewBookDetails(bookId) {
            this.$router.push({ name: 'BookDetails', params: { id: bookId } });
        },


    }
};
</script>



<style scoped>
.search-results ul {
    padding: 0;
    list-style-type: none;
}

.search-results li {
    margin-bottom: 10px;
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 0.25rem;
    padding: 10px;
}
</style>
