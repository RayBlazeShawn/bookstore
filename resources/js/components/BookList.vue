<template>
    <div class="book-list">
        <h2>Book List</h2>
        <button v-if="isAdmin" @click="showAddModal">Add New Book</button>
        <ul class="list-group">
            <li class="list-group-item" v-for="book in books" :key="book.id">
                <b>Book Name:</b> {{ book.title }} <br> <b>Author Name:</b> {{ book.author }}
                <span v-if="isAdmin">
                    <button @click="editBook(book)">Edit</button>
                    <button id="red" @click="deleteBook(book.id)">Delete</button>
                </span>
            </li>
        </ul>
        <h2> Pagination Links</h2>
        <ul class="pagination">

            <li v-for="page in pagination.last_page" :key="page" class="page-item">
                <button @click="fetchBooks(page)" class="page-link">{{ page }}</button>
            </li>
        </ul>
    </div>
    <!-- Book Form Modal -->
    <book-form-modal
        :show="showBookFormModal"
        :book="selectedBook"
        @close="closeBookFormModal"
        @submit="handleBookFormSubmit" />

    <!-- Confirm Delete Modal -->
    <confirm-delete-modal
        :show="showConfirmDeleteModal"
        :bookId="selectedBookId"
        @close="closeConfirmDeleteModal"
        @confirm="confirmBookDeletion" />

</template>

<script>
import axios from 'axios';
import BookFormModal from './BookFormModal.vue';
import ConfirmDeleteModal from './ConfirmDeleteModal.vue';

export default {
    components: {
        BookFormModal,
        ConfirmDeleteModal
    },
    data() {
        return {
            books: [],
            showBookFormModal: false,
            showConfirmDeleteModal: false,
            selectedBook: null,
            selectedBookId: null,
            pagination: {
                current_page: 1,
                last_page: 1,
                // Add other necessary pagination properties
            },
        };
    },
    computed: {
        isAdmin() {
            // Temporary hardcoded check for development
            return true; // Or false
        }
    },

    mounted() {
        this.fetchBooks();
    },

    methods: {
        fetchBooks(page = 1) {
            axios.get(`/api/books?page=${page}`)
                .then(response => {
                    this.books = response.data.data;
                    this.pagination = response.data; // Store the entire pagination response
                })
                .catch(error => {
                    console.error('Error fetching books:', error);
                });
        },
        showAddModal() {
            this.selectedBook = null;
            this.showBookFormModal = true;
        },
        editBook(book) {
            this.selectedBook = book;
            this.showBookFormModal = true;
        },
        deleteBook(bookId) {
            this.selectedBookId = bookId;
            this.showConfirmDeleteModal = true;
        },
        closeBookFormModal() {
            this.showBookFormModal = false;
        },
        closeConfirmDeleteModal() {
            this.showConfirmDeleteModal = false;
        },
        handleBookFormSubmit(bookData) {
            if (this.selectedBook) {
                // Edit mode: Update the book
                axios.put(`/api/books/${this.selectedBook.id}`, bookData)
                    .then(response => {
                        // Handle the response, e.g., update the book list
                        this.fetchBooks(); // Assuming you have a method to refresh the book list
                    })
                    .catch(error => {
                        // Handle the error, e.g., show a message to the user
                    });
            } else {
                if (bookData.title && bookData.author) { // Ensure that book data is not empty

                    // Add mode: Create a new book
                    axios.post('/api/books', bookData)
                        .then(response => {
                            // Handle the response
                            this.fetchBooks();
                            this.closeBookFormModal(); // Close the modal

                        })
                        .catch(error => {
                            // Handle the error
                        });

                }
            }
            this.closeBookFormModal();
        },
        confirmBookDeletion(bookId) {
            axios.delete(`/api/books/${bookId}`)
                .then(response => {
                    // Handle the successful deletion, e.g., refresh the book list
                    this.fetchBooks();
                })
                .catch(error => {
                    // Handle the error, e.g., show an error message
                });
            this.closeConfirmDeleteModal();
        },

    }

};
</script>

<style scoped>
.book-list {
    margin: 20px;
}
button {
    padding: 5px 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 20px;
    margin-right: 10px;
    margin-left: 4px;
}

#red{
    padding: 5px 10px;
    background-color: red;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 20px;
    margin-right: 10px;
    margin-left: 4px;
}
button:hover {
    background-color: #0056b3;
}
.pagination {
    display: flex;
    list-style-type: none;
    padding: 0;
}

.page-item {
    margin-right: 5px;
}

.page-link {
    border: 1px solid #ddd;
    padding: 5px 10px;
    text-decoration: none;
    color: #333;
}

.page-link:hover {
    background-color: #eee;
}
</style>
