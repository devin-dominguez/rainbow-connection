# Rainbow Connection

## Installation and Setup
- `git clone`
- `cd rainbow-connection`

### Laravel Back End Setup
- `composer update`
- Setup the environment by editing .env
- `php artisan migrate`
- `php artisan serve`
- Seed the database by making a POST request to `localhost:8000/api/testData` or wherever you are serving Laravel from. Send `{ "userCount" : 500 }`

### Ember Front End Setup
- `cd frontend`
- `npm install`
- `bower install`
- Set the host in `frontend/app/adapters/application.js` to wherever you are serving Laravel from
- `ember serve`
- Navigate to `localhost:4200` or wherever you are serving Ember from.

## Notes

### Data Model
~~~~
  User
  first_name - string
  last_name  - string
  color      - integer

  Friendship
  user_id    - integer
  friend_id  - integer
~~~~

Users have friends through the Friendship model. Friendships are unidirectional but are always created/destroyed in pairs so they function bidirectionally in the app.

### API Routes
- `GET api/users` paginated index of users with embedded friends
- `GET api/users/{id}` get user with embedded friends
- `POST api/users` create a new user
- `PATCH api/users/{id}` update a user
- `DELETE api/users/{id}` destroy a user
- `POST api/testData` seed database. Send {"userCount": [number of users]}
- `POST api/users/{id}/unfriend` a not very RESTfull way to remove a friend connection.

### Front End Routes
- `/` paginated index of users and friends
- `/{user_id}` show page for user

### Ember Notes
Pagination is achieved with [ember-infinity](https://github.com/hhff/ember-infinity).

Anything that persists data to the DB is done in a less than ideal way due to me having a lot of trouble dealing with adapters/serializers and all sorts of complex Ember Data stuff in a short ammount of time.

## TODO
- rewrite backend to be much more RESTfull and less hacky
- actually understand how Ember data/serializers/adapters work and rewrite accordingly
- optimize for mobile
- have the Ember stuff hosted by the Laravel stuff so I don't to deal with CORS
