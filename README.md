# Bookstore Application

A Vue.js and Laravel-based online bookstore application that allows users to browse, search, and view details of various books. It also features admin functionalities for managing the book inventory.

## Features

- **Book Browsing:** Users can view a list of books.
- **Search Functionality:** Books can be searched and filtered by title, author, publication date, ISBN, and genre.
- **Book Details:** Detailed information about each book is available on a separate product page.
- **Admin Functions:** Admin users can add, edit, or delete books. (Note: Admin status is currently hardcoded for simplification  purposes.)

## Technologies Used

- Frontend: Vue.js 3
- Backend: Laravel 10
- Styling: Bootstrap 5
- Database: MySQL

## Setup and Installation

### Prerequisites

- PHP >= 8.0
- Composer
- Node.js and npm
- A SQL database server

###  Setup

1. Clone the repository:
git clone https://github.com/RishabhGuptaRoger/bookstore.git

2. Navigate to the project directory and install PHP dependencies:
composer install

3. Copy `.env.example` to `.env` and configure your database settings.

4. Run database migrations:
php artisan migrate

5. Seed the database with sample data:
php artisan db:seed --class=BookSeeder(i've used faker api)

2. Install JavaScript dependencies:
npm install

3. Compile for development:
npm run dev

4. For production, compile and minify:
npm run build


## Usage

- **View Books:** Access the home page to browse the book list.
- **Search Books:** Use the search page to filter books based on different attributes.
- **View Book Details:** Click on any book title to view detailed information.
- **Admin Functions:** If logged in as an admin (currently hardcoded for demonstration), additional options for adding, editing, and deleting books are available.

## Book List Page/Home Page

![Screenshot from 2023-11-13 13-19-56](https://github.com/RayBlazeShawn/bookstore/assets/87115048/d840d353-fb0c-4a08-a738-52831e879f3f)
![Screenshot from 2023-11-13 13-20-10](https://github.com/RayBlazeShawn/bookstore/assets/87115048/918a6edb-f0ba-4c85-9ccd-1c716f3dc347)

## Search Page
![Screenshot from 2023-11-13 13-21-31](https://github.com/RayBlazeShawn/bookstore/assets/87115048/450d4cdc-816f-4b85-a456-4cf7422ef3d5)

## Book Detail Page/Product Page

![Screenshot from 2023-11-13 13-21-51](https://github.com/RayBlazeShawn/bookstore/assets/87115048/ae0ba506-4085-496e-9e38-2a2f0936df11)
## Admin Page

![Screenshot from 2023-11-13 13-22-18](https://github.com/RayBlazeShawn/bookstore/assets/87115048/05327526-ed8b-4745-9923-d37ef875f3fc)
It is the same page as homepage just admin role 

### Admin Role Simulation

For development purposes, admin functionalities are triggered with a hardcoded flag in the `BookList.vue` component which is in this path "resources/js/components/BookList.vue":

```vue
<template>
<!-- ... -->
<span v-if="isAdmin">
 <button @click="editBook(book)">Edit</button>
 <button @click="deleteBook(book.id)">Delete</button>
</span>
<!-- ... -->
</template>

<script>

computed: {
 isAdmin() {
   return true; // Set it false to simulate a customer or regular user
 }

</script>

