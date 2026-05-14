# Models and Database

### Contents

- [Database connection](#database-connection)
- [Creating a model](#creating-a-model)
- [Finding records](#finding-records)
- [Creating records](#creating-records)
- [Updating records](#updating-records)
- [Deleting records](#deleting-records)
- [Collections and items](#collections-and-items)
- [Advanced model queries](#advanced-model-queries)
- [Casts, timestamps, and related deletes](#casts-timestamps-and-related-deletes)

<a id="database-connection"></a>
### Database connection

Lima connects to MySQL through PDO. The required database values live in your `.env` file:

```text
DB_HOST=localhost
DB_NAME=my_database
DB_USER=root
DB_PASS=
```

These are loaded when the app starts. For the full list of supported environment variables, see [Configuration](/docs/configuration).

<a id="creating-a-model"></a>
### Creating a model

Models extend `Lima\Core\Model`. At minimum, a model needs a table name.

```php
use Lima\Core\Model;

class Post extends Model
{
    protected $table = 'posts';
}
```

If you don't set a primary key, Lima will use the table name followed by `_id`. For the `posts` table, that means `posts_id`.

You can set a custom primary key when your table uses a different column.

```php
class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
}
```

<a id="finding-records"></a>
### Finding records

The `getByID()` method returns a single item or `null`.

```php
$posts = new Post();
$post = $posts->getByID(12);
```

For custom queries, models also have access to the query builder.

```php
$posts = (new Post())
    ->where('status', 'published')
    ->order('date_created', 'DESC')
    ->limit(10)
    ->getAll();
```

Use `getAll()` when you always want a collection, `getSingle()` when you want the first matching item, and `get()` when either a single item or collection is acceptable.

<a id="creating-records"></a>
### Creating records

Use `create()` to insert a new row.

```php
$post = (new Post())->create([
    'title' => 'Hello Lima',
    'status' => 'draft',
]);
```

When the insert succeeds, Lima returns the newly created item. If the insert fails, it returns `false`.

By default, models add `date_created` and `date_updated` values during creation. You can change this with the model's `$timestamps` property.

<a id="updating-records"></a>
### Updating records

Updates are built with a query condition followed by `update()`.

```php
$updated = (new Post())
    ->where('post_id', 12)
    ->update([
        'status' => 'published',
    ]);
```

When timestamps are enabled, Lima will update the `date_updated` column automatically.

<a id="deleting-records"></a>
### Deleting records

Deletes also use the query builder flow.

```php
$deleted = (new Post())
    ->where('post_id', 12)
    ->delete();
```

Because this is a direct delete, always set the right `where()` or `wheres()` condition before calling `delete()`.

<a id="collections-and-items"></a>
### Collections and items

`getAll()` returns a `Collection`. Collections include a few small helpers:

```php
$posts = (new Post())->getAll();

$posts->items();
$posts->first();
$posts->last();
$posts->count();
$posts->isEmpty();
```

Individual rows are returned as `Item` objects. An item behaves like an array and also includes conversion helpers.

```php
echo $post['title'];

$key = $post->getKey();
$array = $post->toArray();
$object = $post->toObject();
```

<a id="advanced-model-queries"></a>
### Advanced model queries

Every model extends Lima's query builder, so you can compose more specific database queries directly from a model instance.

```php
$items = (new Post())
    ->select(['post_id', 'title'])
    ->where('status', 'published')
    ->order('date_created')
    ->limit(5)
    ->getAll();
```

Supported query methods include `select()`, `where()`, `wheres()`, `limit()`, `offset()`, `order()`, `insert()`, `update()`, `delete()`, `get()`, `getSingle()`, `getAll()`, and `getCount()`.

<a id="casts-timestamps-and-related-deletes"></a>
### Casts, timestamps, and related deletes

Models include a few properties for shaping data behaviour.

```php
class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $timestamps = ['created', 'updated'];
    protected $casts = [
        'published_at' => 'datetime',
    ];
}
```

The `datetime` cast accepts a `DateTime` object or a date string and stores it in `Y-m-d H:i:s` format.

You can disable automatic timestamps by setting an empty array:

```php
protected $timestamps = [];
```

Models also support a `$foreignKeys` map for deleting related rows when a parent row is deleted.

```php
protected $foreignKeys = [
    'post_id' => [
        [Comment::class, 'post_id'],
    ],
];
```

This is useful for small projects, but advanced applications may prefer database-level foreign keys and cascading rules so the database remains the source of truth.
