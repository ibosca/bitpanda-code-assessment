![Logo of the project](https://cdn.bitpanda.com/media/redesign/bitpanda-logo.svg)

# Bitpanda code assessment #1

Isaac Boscà's solution for Bitpanda code assesment #1.

## Getting Started

### Prerequisites

The following software is necessary to run the project:

- `PHP 8`
- `Composer 2`
- `Docker`

I provided a convenient way to get up and running the project database using `Docker`.
Not needed if there is another database ready on the system.

### Installation

In order to install the project, simply run:

```bash
$ make install
```

### Running the app

```bash
$ make run
```
After running this command, the app will be available at `http://localhost:8000`.

## Tests

You can run the tests using the following command:

```bash
$ make test
```

There are two kind of tests in this project:

- `Unit testing` Understanding "unit" as a single use case. These tests run fast and ensure all the collaborators of an Application Service are properly orchestrated.


- `Acceptance` (also called *Feature*). Test the whole workflow of a request. These tests run slower than unit ones, but provides a more real-world behaviour since they use real infrastructure.

Tests live in the `test` directory at project's root directory. It replicates the `src` directory structure.
Unit tests live inside `Application` directory, while Acceptance ones live in `Infrastructure`. The `Domain` directory is reserved for factory classes.

## Get a taste

### Searching for users

The following request will return active users from Austria.

`GET` http://localhost:8000/api/users?isActive=1&countryId=1


### Update a user

The following request will update user with id 1.

`PUT` http://localhost:8000/api/users/1

```json
{
    "countryId": 1,
    "firstName": "Isaac",
    "lastName": "Boscà",
    "phoneNumber": "0034680266475"
}
```

### Remove a user

The following request will remove user with id 2.

`DELETE` http://localhost:8000/api/users/2
