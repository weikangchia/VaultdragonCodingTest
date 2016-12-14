# Vaultdragon Coding Test
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/e9cd6601ec484bae977b4b18256138b8)](https://www.codacy.com/app/weikangchia/VaultdragonCodingTest?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=weikangchia/VaultdragonCodingTest&amp;utm_campaign=Badge_Grade)

### Introduction
This is a project to demonstrate a controlled key-value store with a HTTP API which can be query. The API:

1. Accept a key(string) and value(some json blog/string) and store them. If an existing key is sent, the value will be updated.
2. Accept a key and return the corresponsing latest value.
3. When given a `key` and a `timestamp`, return whatever the value of the key at the time was.

For simplicity, we assume only `GET` and `POST` requests.

Server: http://laravel-mysql-example-vaultdragon-coding-test.44fs.preview.openshiftapps.com

### Example ###
Method: `POST`  

Endpoint: `/api/v1/object`  

Body: JSON: `{"mykey" : "value1"`}  

Time: `11:47am`

---

Method: `GET`

Endpoint: `/api/v1/object/mykey`

Response: `{
  "value": "value1",
  "timestamp": 1481629624,
  "status_code": 200
}`

------

Method: `POST`

Endpoint: `/api/v1/object`

Body: JSON: `{"mykey" : "value2"}`

Time: `3:50pm`

------

Method: `GET`  

Endpoint: `/api/v1/object/mykey`

Response: `{
  "value": "value2",
  "timestamp": 1481644216,
  "status_code": 200
}`

------

Method: `GET`  

Endpoint: `/api/v1/object/mykey?timestamp=1481630624 [12.03pm]`

Response: `{
  "value": "value1",
  "timestamp": 1481629624,
  "status_code": 200
}`


All timestamps are unix timestamps according UTC timezone.

### Sitemap
* [Installation Guide](docs/InstallationGuide.md)  
* [Testing Guide](docs/TestingGuide.md)
