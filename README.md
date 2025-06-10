
# Elysia 🔍✨

A powerful, customizable query string filter package for Laravel that lets you filter, sort, and search models using query parameters — without writing repetitive query logic.

## 🚀 Features

- 🔄 Sort by fields with ease
- 🔎 Search using LIKE
- 📥 Filter with IN clause
- 🎯 Supports custom query string mapping per model
- 🧩 Fully extensible and easy to integrate
- 🧼 Clean, well-structured codebase

## 📦 Installation

```bash
composer require sofronz/elysia
```

## 🛠️ Configuration

Publish the config (optional):

```bash
php artisan vendor:publish --provider="Sofronz\Elysia\ElysiaServiceProvider" --tag="config"
```

`config/elysia.php`:

```php
return [
    'models' => [
        'user' => App\Models\User::class,
        'post' => App\Models\Post::class,
    ],
];
```

## ⚙️ Usage

In your controller:

```php
use Sofronz\Elysia\Facades\Filter;
use App\Models\User;

public function index()
{
    $filteredUsers = Filter::model('user')->apply(User::query())->get();

    return response()->json($filteredUsers);
}
```

## 🔁 Custom Query Parameters

By default, the `Filter` package applies filters using query parameters such as `?field_sort=field_name`, `?field_like=value`, and `?field_in=value1,value2`. However, you can customize the query parameter names directly in your model.

#### Step 1: Add `getQueryStringMapping` Method in the Model

To customize the query parameters, implement a `getQueryStringMapping` method in your model. This method should return an array where the keys are the custom query parameters, and the values are the corresponding model fields.

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YourModel extends Model
{
    /**
     * Map query string parameters to model attributes.
     *
     * @return array
     */
    public static function getQueryStringMapping(): array
    {
        return [
            'name_search' => 'name',  // custom query parameter `name_search` maps to `name` field
            'email_like' => 'email',  // custom query parameter `email_like` maps to `email` field
            'status_in' => 'status',  // custom query parameter `status_in` maps to `status` field
            'created_at_sort' => 'created_at',  // custom query parameter `created_at_sort` maps to `created_at` field
        ];
    }
}
```

In the example above, the custom query parameters are:

- `name_search` will filter by `name` field.
- `email_like` will perform a LIKE search on the `email` field.
- `status_in` will filter by `status` field using the `IN` clause.
- `created_at_sort` will sort by `created_at` field.

#### Step 2: Apply the Filters with Custom Query Parameters

Now that you've defined custom query parameters in the model, you can use them directly in the request.

Example:

```bash
GET /your-model?name=John&email=john.doe%40example.com&status=active,inactive&created_at=-created_at
```

This will:

- Search for records where the `name` field contains "John".
- Perform a `LIKE` search on the `email` field.
- Filter records where the `status` is either "active" or "inactive".
- Sort the records by the `created_at` field in descending order.

### Available Filters

- **Sort**: Add a custom query parameter like `?field_sort=field_name` to apply sorting.
- **LIKE**: Add a custom query parameter like `?field_like=value` to perform a LIKE search.
- **IN**: Add a custom query parameter like `?field_in=value1,value2` to filter using the `IN` clause.
- **Basic Where**: Add custom query filters by passing fields that exist in the model's `$fillable` attribute.

By using the `getQueryStringMapping` method, you can easily customize and map query parameters to any field in your model, giving you full control over how filters are applied in your application.

## 🙌 Shout Out

Special thanks to [ChatGPT](https://openai.com/chatgpt) 🤖 for assisting with the design and development of this package.

If you like my work or find it useful, you can support me through:

[![Buy Me a Coffee](https://img.shields.io/badge/Buy%20me%20a%20coffee-orange?logo=buy-me-a-coffee&style=for-the-badge)](https://ko-fi.com/sofronzz)  
[![Saweria](https://img.shields.io/badge/Saweria-donate-orange?style=for-the-badge)](https://saweria.co/sofronz)

## 👨‍💻 Author

**Sofronius Ruddy** (GitHub: [@sofronz](https://github.com/sofronz))  
Copyright (c) 2025  
All rights reserved.

## 📝 License

MIT © 2025 Sofronz/Elysia. All rights reserved.
