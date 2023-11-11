<template>
    <div v-if="book" class="book-container">

        <!-- Left Section for Book Image -->
        <div class="book-image">
            <img :src="'/storage/defaultImage.jpg'" :alt="book.title" />
        </div>


        <!-- Right Section for Book Details -->
        <div class="book-details">
            <span>        <button @click="goToBookList" class="back-to-list-btn">Back to Book List</button></span>
            <h2>{{ book.title }}</h2>
            <p>Author: {{ book.author }}</p>
            <p>ISBN: {{ book.isbn }}</p>
            <p>Genre: {{ book.genre }}</p>
            <p>Publication Date: {{ book.publication_date }}</p>
            <p>Description: {{ book.description }}</p>
        </div>
    </div>


    <!-- Similar Books Section -->
    <div v-if="book" class="similar-books">
        <h3 style="text-align: center">Similar Books</h3>
        <div class="book-grid">
            <div v-for="similarBook in similarBooks" :key="similarBook.id" @click="viewBookDetails(similarBook.id)" class="book">
                <img :src="'/storage/defaultImage.jpg'" :alt="similarBook.title" />
                <h5>{{ similarBook.title }}</h5>
            </div>
        </div>
    </div>
    <div v-if="book" >

    </div>

    <div v-else>
        Loading book details...
    </div>
</template>


<script>
import axios from 'axios';

export default {
    props: ['id'],
    data() {
        return {
            book: null,
            similarBooks: [] // Array to hold similar books
        };
    },
    mounted() {
        this.fetchBookDetails();
    },
    watch: {
        // Watch for changes in the id prop
        id(newId, oldId) {
            if (newId !== oldId) {
                this.fetchBookDetails();
            }
        }
    },
    methods: {
        fetchBookDetails() {
            axios.get(`/api/books/${this.id}`)
                .then(response => {
                    this.book = response.data;
                    this.fetchSimilarBooks(); // Fetch similar books after getting the details
                })
                .catch(error => {
                    console.error('Error fetching book details:', error);
                });
        },

        fetchSimilarBooks() {
            axios.get('/api/books') // Replace with your API endpoint
                .then(response => {
                    if (Array.isArray(response.data.data)) {
                        this.similarBooks = response.data.data.slice(0, 6);
                    }
                })
                .catch(error => {
                    console.error('Error fetching similar books:', error);
                });
        },
        viewBookDetails(bookId) {
            this.$router.push({ name: 'BookDetails', params: { id: bookId } });
        },
        goToBookList() {
            this.$router.push('/books');
        }
    },
};
</script>
<style scoped>
.book-container {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 50px;
}

.book-image {
    flex: 1;
    text-align: center;
}

.book-image img {
    max-width: 300px;
}

.book-details {
    flex: 2;
}

.similar-books .book-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
}

.similar-books .book {
    cursor: pointer;
    text-align: center;
}

.similar-books .book img {
    max-width: 150px;
    height: auto;
}
.back-to-list-btn {
    /* Add your styling here */
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 20px;
}

.back-to-list-btn:hover {
    background-color: #0056b3;
}
</style>

