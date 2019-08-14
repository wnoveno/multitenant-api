A Multitenant API Boilerplate 
========
A Multitenant API Boilerplate built on Symfony4

[![Build Status](https://travis-ci.org/wnoveno/multitenant-api.svg?branch=master)](https://travis-ci.org/wnoveno/multitenant-api)

* Uses JWT for authentication
* Protected and unprotected routes

### Usage

Unprotected Routes

`https://[tenant1].domain.com/validate`
`https://[tenant2].domain.com/validate`

Protected Routes are under the /api route

`https://[tenant1].domain.com/api/users`
`https://[tenant2].domain.com/api/users`

 Request Header should contain the Auth token from received /login
 
 `Authorization : Bearer [token]`

Multitenant Code is under

`src/Multi`

Custom API Code should be under

`src/Api`

Creating a new tenant

`./tenant.sh [tenant_name]`

Updating Tenant after change to entities

`./update_tenant [tenant_name]` 



