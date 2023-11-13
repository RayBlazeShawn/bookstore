<template>
    <div class="modal" v-if="show">
        <div class="modal-content">
            <span @click="closeModal" class="close">&times;</span>
            <h2>{{ isEditMode ? 'Edit Book' : 'Add Book' }}</h2>

            <form @submit.prevent="submitForm">
                <input v-model="bookData.title" placeholder="Title" />
                <input v-model="bookData.author" placeholder="Author" />
                <input v-model="bookData.publication_date" type="date" placeholder="Publication Date" />
                <input v-model="bookData.isbn" placeholder="ISBN" />
                <input v-model="bookData.genre" placeholder="Genre" />

                <button style="margin-top: 5px" type="submit">{{ isEditMode ? 'Update' : 'Add' }} Book</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        show: Boolean,
        book: Object
    },
    data() {
        return {
            bookData: {
                title: '',
                author: '',
                publication_date: '',
                isbn: '',
                genre: ''

            },
            isEditMode: false
        };
    },
    watch: {
        book: {
            immediate: true,
            handler(newVal) {
                if (newVal) {
                    this.bookData = { ...newVal }; // Copying the book data
                    this.isEditMode = true;
                } else {
                    this.bookData = {
                        title: '',
                        author: '',
                        publication_date: '',
                        isbn: '',
                        genre: ''
                        // Resetting  fields
                    };
                    this.isEditMode = false;
                }
            }
        }
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },
        submitForm() {
            this.$emit('submit', this.bookData);
            if (!this.isEditMode) {
                this.bookData = {
                    title: '',
                    author: '',
                    publication_date: '',
                    isbn: '',
                    genre: ''
                };
            }
        }
    }
};
</script>



<style scoped>
.modal {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.close {
    float: right;
    font-size: 1.2em;
    cursor: pointer;
}

button {
    padding: 5px 10px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    margin-bottom: 20px;
}

button:hover {
    background-color: #0056b3;
}
</style>

