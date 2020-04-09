# Add one to one chat to your Laravel app using Stream Chat

![Samle](./one-on-one.gif)


## Setting up the app

1. Clone the project to your system:

```sh
git clone https://github.com/dongido001/stream-laravel-one-on-one-chat.git
```

2. Install dependencies

    a. PHP dependencies
    ```sh
    composer install
    ```

    b. JavaScript dependencies

    ```sh
    yarn install
    ```

3. Run build

```sh
yarn run dev
```

4. Set up the database

```sh
cp .env.example .env
```

a. Then update the `.env` file with your correct database details.

b. Update your Stream Chat API key

    STREAM_API_KEY=<YOUR STREAM API KEY>
    STREAM_API_SECRET=<YOUR STREAM API SECRET>

    MIX_STREAM_API_KEY="${STREAM_API_KEY}"
    MIX_STREAM_API_SECRET="${STREAM_API_SECRET}"

5. Run migration

```
php artisan migrate
```

6. Serve the app

```sh
php artisan serve
```

Now visit the development URL to start chatting: [http://localhost:8000](http://localhost:8000)

## Built with

1. [Vue.js](https://vuejs.org/)
2. [Laravel](https://laravel.com/)
3. [Stream Chat](https://getstream.io/chat/docs/)
