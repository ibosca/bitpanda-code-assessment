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

Create a `.env` file from `.env.example`.

Then run:

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

### Create a user

The following request will create a user with id 99.

`PUT` http://localhost:8000/api/users/99

```json
{
    "email": "isaacbncl@gmail.com",
    "isActive": true,
    "detail": {
        "countryId": 1,
        "firstName": "Isaac",
        "lastName": "Boscà",
        "phoneNumber": "0034680266475"
    }
}
```

### Remove a user

The following request will remove user with id 2.

`DELETE` http://localhost:8000/api/users/2


## Considerations

### Directory Structure

As you can see, I overridden Laravel's default directory structure. 
The core of the app lives in the `/src` directory. This is a first layer to decoupling from the framework.

At the first level of the `/src` you will find `Shared` and `User` directories.
What I'm doing here is split the code by modules, allowing the company to manage more easily the project if at some point needs to split the project in more than one, and dedicate more resources into one of these modules.

In a real-life application, I would differentiate between `Bounded context` and `Module`. As the assessment does not provide enough context, I decided to skip the `Bounded Context`.

### Domain Driven Design

This is a big topic, but I want to explain a little the software architecture I implemented. 

#### Hexagonal Architecture

Code inside module folders, `User` in this case, is divided in three layers:

- **Application** Where the use cases (application services) live.
- **Domain** Where our domain logic and classes definitions lives.
- **Infrastructure** Where the code that "does not belong to us lives". Is used to decoupled from our infrastructure (databases, framework, orm, mailer provider...)

The rule here is that an inner layer shouldn't know about an outer one. Domain is the center, then goes Application, and the outer one is Infrastructure.

#### Repository pattern and Outside in implementation

At Infrastructure layer you will find the repository implementations.
This implementation is coupled to a concrete piece of infrastructure, for this reason is placed into Infrastructure, to be able to change it easily when the company needs to.

These implementations are not injected directly to the use cases, instead, we are using a abstraction layer, interfaces that lives in the domain layer.
Every new implementation should follow the contract that this interfaces is exposing. 
With this, we are ensuring that no Application or Domain code will be modified because of a change in our infrastructure code.

An important note on that is, the interfaces should be defined before our implementation is coded, in order to avoid infrastructure leaks to our domain.

#### Criteria pattern

The assessment asked for a request to get Austrian and active users, so what we could do is a repository method like `getAustrianAndActiveUsers()`.
What if the company needs to look for Italian and not active? Method explosion.

I created a Criteria object to have enough flexibility, while decoupling from the database tables.

### Testing

There are two kind of tests in this project:

- `Unit testing` Understanding "unit" as a single use case. These tests run fast and ensure all the collaborators of an Application Service are properly orchestrated.

- `Acceptance` (also called *Feature*). Test the whole workflow of a request. These tests run slower than unit ones, but provide a more real-world behaviour since they use real infrastructure.

Tests live in the `test` directory at project's root directory. It replicates the `src` directory structure.
Unit tests live inside `Application` directory, while Acceptance ones live in `Infrastructure`. The `Domain` directory is reserved for factory classes.

Although not required, I implemented a `POST` endpoint for creating users. The reason for that is to encapsulate the whole logic of delete test, and ensure the test does not rely on a specific database status.


### REST API

I used `GET`, `POST`, `PUT` and `DELETE` http methods and plural nouns for endpoints.

As you can see, `POST` method (create user) requires the user ID.
Giving the identifiers from outside has some great benefits like:

- Our aggregates are valid through the whole life-cycle.
- Write requests does not need to return any data.
- Ease of apply CQRS pattern

For sure, `UUID` would match much better this pattern.

Last but not least, the error management is done using a framework middleware to catch domain exceptions and return the correct HTTP code and message.
