<template>
    <div class="modal" v-if="show">
        <div class="modal-content">
            <span @click="closeModal" class="close">&times;</span>
            <h2>Confirm Deletion</h2>
            <p>Are you sure you want to delete this book?</p>
            <button @click="confirmDeletion">Confirm</button>
            <button @click="closeModal">Cancel</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        show: Boolean,
        bookId: Number
    },
    methods: {
        closeModal() {
            this.$emit('close');
        },
        confirmDeletion() {
            this.$emit('confirm', this.bookId);
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
    margin-top: 10px;
    padding: 5px 10px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

button:hover {
    opacity: 0.8;
}
</style>
