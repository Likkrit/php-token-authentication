A simple JSON token signature and authentication in PHP
---
This is simple JSON token signature and authentication, just like JWT, but more lite.

## Usage

`token.php` has three functions.
You can use `createToken()` to create an encoded token string,
and use `verifyToken()` to verify an encoded token.
But before that, maybe you need to modify some parameters.

```php
createToken(1);
//eyJpZCI6MSwiZXhwIjoxNDgwMzE1NDE2fQ.b20ca811dd37482b

verifyToken('eyJpZCI6MSwiZXhwIjoxNDgwMzE1NDE2fQ.b20ca811dd37482b');
//stdClass Object ( [id] => 1 [exp] => 1480315416 )
```

