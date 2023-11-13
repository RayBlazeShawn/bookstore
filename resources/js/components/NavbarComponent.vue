<template>
    <nav class="navbar">
        <router-link to="/books" class="nav-link">Home</router-link>
        <router-link to="/search" class="nav-link">Search</router-link>
    </nav>
</template>



<style scoped>
.navbar {
    display: flex;
    justify-content: space-around;
    align-items: center;
    padding: 1rem;
    background-color: #333;
}

.nav-link {
    color: white;
    text-decoration: none;
    padding: 0.5rem 1rem;
}

.nav-link:hover {
    background-color: #555;
}

@media (max-width: 600px) {
    .navbar {
        flex-direction: column;
    }
}
</style>
