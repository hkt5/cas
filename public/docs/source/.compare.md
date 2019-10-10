---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_669c21a0ec50102c5d7a38fdaec7d34e -->
## Register user.

[ Register new user. ]

> Example request:

```bash
curl -X POST "/register" \
    -H "Content-Type: application/json" \
    -d '{"first_name":"et","last_name":"quos","email":"et","phone":"ut","password":"qui"}'

```

```javascript
const url = new URL("/register");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "first_name": "et",
    "last_name": "quos",
    "email": "et",
    "phone": "ut",
    "password": "qui"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": "eyJmaXJzdF9uYW1lIjoiSm9obiIsImxhc3RfbmFtZSI6IkRvZSIsImVtYWlsIjoiam9obkBkb2UuY29tIiwicGhvbmUiOiIwMDAtMDAwLTAwMCIsImlzX2FkbWluIjpmYWxzZSwiaXNfY29uZmlybWVkIjpmYWxzZSwiY29uZmlybWF0aW9uX2xpbmsiOiJ0cTE2NzJpMzhvIiwiaXNfYWN0aXZlIjpmYWxzZSwibGFzdF9sb3N0X3Bhc3N3b3JkX2xpbmsiOiJmYWVrOXc1bXljIiwibGFzdF9wYXNzd29yZF9tb2RpZmljYXRpb24iOiIyMDE5LTEwLTAyVDEwOjA4OjMxLjUyMTgzMFoiLCJiYWRfbG9naW4iOjAsInVwZGF0ZWRfYXQiOiIyMDE5LTEwLTAyIDEwOjA4OjMxIiwiY3JlYXRlZF9hdCI6IjIwMTktMTAtMDIgMTA6MDg6MzEiLCJpZCI6Mn0=",
    "error_messages": null
}
```

### HTTP Request
`POST /register`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    first_name | string |  required  | First name of new user.
    last_name | string |  required  | Last name of new user.
    email | email |  required  | Email of new user.
    phone | string |  required  | Phone of new user.
    password | string |  required  | Password of new user.

<!-- END_669c21a0ec50102c5d7a38fdaec7d34e -->

<!-- START_3c93c2debeebd51606066efaf55cd95d -->
## Login with phone.

[ Login user with phone and password. ]

> Example request:

```bash
curl -X POST "/loginWithEmail" \
    -H "Content-Type: application/json" \
    -d '{"phone":"optio","password":"et"}'

```

```javascript
const url = new URL("/loginWithEmail");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "phone": "optio",
    "password": "et"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": "eyJmaXJzdF9uYW1lIjoiSm9obiIsImxhc3RfbmFtZSI6IkRvZSIsImVtYWlsIjoiam9obkBkb2UuY29tIiwicGhvbmUiOiIwMDAtMDAwLTAwMCIsImlzX2FkbWluIjpmYWxzZSwiaXNfY29uZmlybWVkIjpmYWxzZSwiY29uZmlybWF0aW9uX2xpbmsiOiJ0cTE2NzJpMzhvIiwiaXNfYWN0aXZlIjpmYWxzZSwibGFzdF9sb3N0X3Bhc3N3b3JkX2xpbmsiOiJmYWVrOXc1bXljIiwibGFzdF9wYXNzd29yZF9tb2RpZmljYXRpb24iOiIyMDE5LTEwLTAyVDEwOjA4OjMxLjUyMTgzMFoiLCJiYWRfbG9naW4iOjAsInVwZGF0ZWRfYXQiOiIyMDE5LTEwLTAyIDEwOjA4OjMxIiwiY3JlYXRlZF9hdCI6IjIwMTktMTAtMDIgMTA6MDg6MzEiLCJpZCI6Mn0=",
    "error_messages": null
}
```

### HTTP Request
`POST /loginWithEmail`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    phone | string |  required  | Phone of user.
    password | string |  required  | Password of user.

<!-- END_3c93c2debeebd51606066efaf55cd95d -->

<!-- START_20ecff2fdb01a559f742fbd2d775cc82 -->
## Login with email.

[ Login user with e-mail and password. ]

> Example request:

```bash
curl -X POST "/loginWithPhone" \
    -H "Content-Type: application/json" \
    -d '{"email":"officiis","password":"sint"}'

```

```javascript
const url = new URL("/loginWithPhone");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "email": "officiis",
    "password": "sint"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": "eyJmaXJzdF9uYW1lIjoiSm9obiIsImxhc3RfbmFtZSI6IkRvZSIsImVtYWlsIjoiam9obkBkb2UuY29tIiwicGhvbmUiOiIwMDAtMDAwLTAwMCIsImlzX2FkbWluIjpmYWxzZSwiaXNfY29uZmlybWVkIjpmYWxzZSwiY29uZmlybWF0aW9uX2xpbmsiOiJ0cTE2NzJpMzhvIiwiaXNfYWN0aXZlIjpmYWxzZSwibGFzdF9sb3N0X3Bhc3N3b3JkX2xpbmsiOiJmYWVrOXc1bXljIiwibGFzdF9wYXNzd29yZF9tb2RpZmljYXRpb24iOiIyMDE5LTEwLTAyVDEwOjA4OjMxLjUyMTgzMFoiLCJiYWRfbG9naW4iOjAsInVwZGF0ZWRfYXQiOiIyMDE5LTEwLTAyIDEwOjA4OjMxIiwiY3JlYXRlZF9hdCI6IjIwMTktMTAtMDIgMTA6MDg6MzEiLCJpZCI6Mn0=",
    "error_messages": null
}
```

### HTTP Request
`POST /loginWithPhone`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    email | email |  required  | Email of user.
    password | string |  required  | Password of user.

<!-- END_20ecff2fdb01a559f742fbd2d775cc82 -->

<!-- START_bf1f5057be9939c7e0ef91a51e92d8c0 -->
## Authorize user.

[ This request must contans X-AUTH header. ]

> Example request:

```bash
curl -X GET -G "/auth" 
```

```javascript
const url = new URL("/auth");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "content": [],
    "error_messages": []
}
```

### HTTP Request
`GET /auth`


<!-- END_bf1f5057be9939c7e0ef91a51e92d8c0 -->

<!-- START_06f1c2988f7abe05be737c719394c0c4 -->
## Confirm account.

[ Confirm your account with confirmation link. ]

> Example request:

```bash
curl -X GET -G "/confirmAccount/1" 
```

```javascript
const url = new URL("/confirmAccount/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "user": {
            "id": 1,
            "first_name": "Jane",
            "last_name": "Doe",
            "email": "jane@doe.com",
            "phone": "000-000-001",
            "is_admin": 0,
            "is_confirmed": true,
            "confirmation_link": "en0m3kthb1",
            "is_active": true,
            "last_lost_password_link": "imjrszoafe",
            "last_password_modification": "2019-10-03 14:44:49",
            "bad_login": 0,
            "created_at": "2019-10-03 14:44:49",
            "updated_at": "2019-10-03 14:44:51"
        }
    },
    "error_messages": [
        []
    ]
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": []
}
```

### HTTP Request
`GET /confirmAccount/{link}`


<!-- END_06f1c2988f7abe05be737c719394c0c4 -->


