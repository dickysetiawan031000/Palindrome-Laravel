# Laravel API

## Description

This project is a Laravel-based API that offers two main features. First, it can check whether a given text is a palindrome, meaning the text reads the same forward and backward. Second, it provides CRUD (Create, Read, Update, Delete) functionality for managing language data. The language data is stored using a caching mechanism to improve performance and data access efficiency.

With caching in place, retrieving language data becomes faster as it does not always require direct database access. This is highly beneficial for improving scalability and reducing server load.

## Installation

1. **Clone this repository**
   ```sh
   git clone git@github.com:dickysetiawan031000/Palindrome-Laravel.git
   cd project_name
   ```
2. **Install dependencies**
   ```sh
   composer install
   ```
3. **Create the .env file**
   ```sh
   cp .env.example .env
   ```
4. **Configure the environment**
   - Adjust the database configuration in the `.env` file.
5. **Generate the application key**
   ```sh
   php artisan key:generate
   ```
6. **Run database migrations**
   ```sh
   php artisan migrate
   ```
7. **Start the local server**
   ```sh
   php artisan serve
   ```

## API Endpoints

### Version: v1

#### 1. Palindrome Check

- **Endpoint:** `GET /api/v1/check-palindrome`
- **Description:** Checks whether a given word or phrase is a palindrome.
- **Example Response:**
  ```json
  {
    "message": "Palindrome"
  }
  ```

#### 2. Language Management

- **Add Language**
  - **Endpoint:** `POST /api/v1/language`
  - **Description:** Adds a new language entry.

- **Get Language by ID**
  - **Endpoint:** `GET /api/v1/language/{id}`
  - **Description:** Retrieves language information based on the provided ID.

- **Get All Languages**
  - **Endpoint:** `GET /api/v1/languages`
  - **Description:** Retrieves a list of all available languages.

- **Update Language**
  - **Endpoint:** `PATCH /api/v1/language/{id}`
  - **Description:** Updates language data based on the provided ID.

- **Delete Language**
  - **Endpoint:** `DELETE /api/v1/language/{id}`
  - **Description:** Deletes a language entry based on the provided ID.

## Handling Unauthorized Methods

If a user accesses a route with an unsupported HTTP method, the API will return a **405 Method Not Allowed** response.

## Postman Collection

To easily test the API, you can import the provided Postman collection:

[Download Postman Collection](postman_collection.json)

Alternatively, you can use the following Postman collection JSON:

```json
{
  "info": {
    "_postman_id": "22c03307-e2b3-45f3-bd3d-6a6a4a530ff3",
    "name": "Technical Test",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Language",
      "item": [
        {
          "name": "Index",
          "request": {
            "method": "GET",
            "url": "http://127.0.0.1:8000/api/v1/languages"
          }
        },
        {
          "name": "Show",
          "request": {
            "method": "GET",
            "url": "http://127.0.0.1:8000/api/v1/language/3"
          }
        },
        {
          "name": "Delete",
          "request": {
            "method": "DELETE",
            "url": "http://127.0.0.1:8000/api/v1/language/3"
          }
        },
        {
          "name": "Store",
          "request": {
            "method": "POST",
            "url": "http://127.0.0.1:8000/api/v1/language",
            "body": {
              "mode": "raw",
              "raw": "{ \"language\": \"Python\", \"appeared\": 1991 }"
            }
          }
        },
        {
          "name": "Edit",
          "request": {
            "method": "PATCH",
            "url": "http://127.0.0.1:8000/api/v1/language/2",
            "body": {
              "mode": "raw",
              "raw": "{ \"language\": \"Laravel edited\" }"
            }
          }
        }
      ]
    },
    {
      "name": "Palindrome Check",
      "request": {
        "method": "GET",
        "url": "http://127.0.0.1:8000/api/v1/check-palindrome",
        "body": {
          "mode": "raw",
          "raw": "{ \"text\": \"wakaw\" }"
        }
      }
    }
  ]
}
```

---

Thank you for using this API! 🚀

